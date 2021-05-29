<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Profile;
use App\Equipment;
use App\Transaction;
use App\Transaction_Item;
use App\Log;

class OperationController extends Controller
{
    public function index(Request $request){
        session()->pull('cart');
        $cadets = Profile::where('profile_type', '=', 'Cadet')->get();
        $items = '';
        return view('equipment.operations.index')
          ->withCadets($cadets)
          ->with('cadet_name', 'No Cadet Selected')
          ->with('cadet_id', '')
          ->with('count_issuance', 0)
          ->with('count_turnin', 0)
          ->with('count_reported', 0)
          ->withItems($items);
    }

    public function get_index($id){
      session()->pull('cart');
      $cadets = Profile::where('profile_type', '=', 'Cadet')->get();
      $cadet_name = '';
      $cdt = Profile::where('id', '=', $id)->first();
      if($cdt){
        $cadet_name  = $cdt->lastname . ', ' .  $cdt->firstname . ' ' . $cdt->middlename . ' C-' . $cdt->sn;
      }

      $count_issuance = DB::table('transaction_items')
          ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
          ->where('cadet_id', $id)
          ->where('type', 'issuance')
          ->where('active', true)
          ->count();
      $count_turnin = DB::table('transaction_items')
          ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
          ->where('cadet_id', $id)
          ->where('type', 'turnin')
          ->where('active', true)
          ->count();
      $count_reported = DB::table('transaction_items')
          ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
          ->where('cadet_id', $id)
          ->where('type', 'reported')
          ->where('active', true)
          ->count();
      $items = DB::select("select transactions.ear,
                  equipments.id,
                  equipments.serial_number,
                  equipments.property_number,
                  equipments.description,
                  transactions.type,
                  transaction_items.updated_at
                from equipments inner join transaction_items on equipments.id = transaction_items.equipment_id
                inner join transactions on transaction_items.transaction_id = transactions.id
                where cadet_id = '$id' and active is true");

      return view('equipment.operations.index')
        ->withCadets($cadets)
        ->with('cadet_name', $cadet_name)
        ->with('cadet_id', $id)
        ->with('count_issuance', $count_issuance)
        ->with('count_turnin', $count_turnin)
        ->with('count_reported', $count_reported)
        ->withItems($items);
    }

    public function load_issuance($id){
      $cadet_name = '';
      $cdt = Profile::where('id', '=', $id)->first();
      if($cdt){
        $cadet_name  = $cdt->lastname . ', ' .  $cdt->firstname . ' ' . $cdt->middlename . ' C-' . $cdt->sn;
      }
      $equipments = DB::select("select equipments.*, account_keywords.commonname from equipments
          inner join account_keywords on equipments.keyword_id = account_keywords.id
          where available is true");

      $select_count = DB::table('transactions')
          ->where('cadet_id', $id)
          ->whereYear('created_at', '=', date('Y'))
          ->count();
      if($select_count==0){
          $count = "0001";
      }elseif($select_count > 0 && $select_count < 10){
          $select_count = $select_count + 1;
          $count = "000" .''. $select_count;
      }elseif($select_count > 9 && $select_count < 100){
          $select_count = $select_count + 1;
          $count = "00" .''. $select_count;
      }
      $ear = date('Y') . "-"  . $id . '-' . $count;
      $cadets = Profile::where('profile_type', '=', 'Cadet')->get();

      return view('equipment.operations.issuance')
        ->withEquipments($equipments)
        ->withCadets($cadets)
        ->with('cadet_name', $cadet_name)
        ->with('cadet_id', $id)
        ->with('ear', $ear);
  }

  public function add_equipment($id){
    $equipment = Equipment::where('id', '=', $id)->first();
    $cart = session()->get('cart');

    //:add equipment in empty list
    if(!$cart){
      $cart = [
        $id => [
          "property_number" => $equipment->property_number,
          "serial_number" => $equipment->serial_number,
          "description" => $equipment->description,
          "unit_value" => $equipment->unit_value,
          "unit_measure" => $equipment->unit_measure
        ]
      ];
      session()->put('cart', $cart);
      return redirect()->back();
    }

    //:do nothing if already in list
    if(isset($cart[$id])){
      //return
      return redirect()->back();
    }

    //:if item not exist
    $cart[$id] = [
      "property_number" => $equipment->property_number,
      "serial_number" => $equipment->serial_number,
      "description" => $equipment->description,
      "unit_value" => $equipment->unit_value,
      "unit_measure" => $equipment->unit_measure
    ];
    session()->put('cart', $cart);
    return redirect()->back();
  }

  public function remove_equipment(Request $request){
    if($request->id) {
        $cart = session()->get('cart');
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
    }
  }

  public function store_issuance(Request $request, $id){
    $transaction = new Transaction();
    $transaction->cadet_id = $id;
    $transaction->type = 'issuance';
    $transaction->ear = $request->ear;
    $transaction->purpose = $request->purpose;
    $transaction->remarks = $request->remarks;
    $transaction->admin_id = Auth::user()->id;
    $transaction->rep_cadet_id = $request->rep_cadet_id;
    $transaction->save();

    $tran_id = '';
    $tran = Transaction::where('ear', '=', $request->ear)->first();
    if($tran){
      $tran_id = $tran->id;
    }
    $cart = session()->get('cart');
    foreach($cart as $cid => $temp){
      $items = new Transaction_Item();
      $items->transaction_id = $tran_id;
      $items->equipment_id = $cid;
      $items->save();

      DB::update("update equipments set available = false where id = $cid");
    }
    /*logs*/
    $log = new Log();
    $log->activity = 'Create new issuance equipment with EAR: '. $request->ear;
    $log->user_id = auth()->user()->id;
    $log->ip_address = request()->ip();
    $log->save();

    session()->put('message', 'New Issuance saved successfully!');
    return redirect()->route('equipment.load.index', $id)->with('success','New issuance created successfully!');
  }

  public function load_turnin($id){
    $cadet_name = '';
    $cdt = Profile::where('id', '=', $id)->first();
    if($cdt){
      $cadet_name  = $cdt->lastname . ', ' .  $cdt->firstname . ' ' . $cdt->middlename . ' C-' . $cdt->sn;
    }
    $equipments = DB::select("select equipments.*, account_keywords.commonname from equipments
        inner join account_keywords on equipments.keyword_id = account_keywords.id
        left join transaction_items on equipments.id = transaction_items.equipment_id
        inner join transactions on transaction_items.transaction_id = transactions.id
        where cadet_id = '$id' and type = 'issuance' and active is true");

    $select_count = DB::table('transactions')
        ->where('cadet_id', $id)
        ->whereYear('created_at', '=', date('Y'))
        ->count();
    if($select_count==0){
        $count = "0001";
    }elseif($select_count > 0 && $select_count < 10){
        $select_count = $select_count + 1;
        $count = "000" .''. $select_count;
    }elseif($select_count > 9 && $select_count < 100){
        $select_count = $select_count + 1;
        $count = "00" .''. $select_count;
    }
    $ear = date('Y') . "-"  . $id . '-' . $count;
    $cadets = Profile::where('profile_type', '=', 'Cadet')->get();

    return view('equipment.operations.turnin')
      ->withEquipments($equipments)
      ->withCadets($cadets)
      ->with('cadet_name', $cadet_name)
      ->with('cadet_id', $id)
      ->with('ear', $ear);
  }

  public function store_turnin(Request $request, $id){
    if($request->input('equipment_id')==''){
      return redirect()->back()->with('warning','No selected equipment! Try again.');
    } else {
      $transaction = new Transaction();
      $transaction->cadet_id = $id;
      $transaction->type = 'turnin';
      $transaction->ear = $request->ear;
      $transaction->purpose = $request->purpose;
      $transaction->remarks = $request->remarks;
      $transaction->admin_id = Auth::user()->id;
      $transaction->rep_cadet_id = $request->rep_cadet_id;
      $transaction->save();

      $tran_id = '';
      $tran = Transaction::where('ear', '=', $request->ear)->first();
      if($tran){
        $tran_id = $tran->id;
      }
      $ids = $request->input('equipment_id');
      foreach($ids as $e){
        $items = new Transaction_Item();
        $items->transaction_id = $tran_id;
        $items->equipment_id = $e;
        $items->save();

        DB::update("update equipments set available = true where id = '$e'");
        DB::update("update transaction_items as s set active = false from transactions
                where s.transaction_id = transactions.id and s.equipment_id = '$e'
                and transactions.type = 'issuance' and active is true");
      }
      /*logs*/
      $log = new Log();
      $log->activity = 'Create new turn-in with EAR: '. $request->ear;
      $log->user_id = auth()->user()->id;
      $log->ip_address = request()->ip();
      $log->save();

      return redirect()->route('equipment.load.index', $id)->with('success','Equipment/s turn in successfully!');
    }
  }

  public function load_report($id){
    $cadet_name = '';
    $cdt = Profile::where('id', '=', $id)->first();
    if($cdt){
      $cadet_name  = $cdt->lastname . ', ' .  $cdt->firstname . ' ' . $cdt->middlename . ' C-' . $cdt->sn;
    }
    $equipments = DB::select("select equipments.*, account_keywords.commonname from equipments
        inner join account_keywords on equipments.keyword_id = account_keywords.id
        left join transaction_items on equipments.id = transaction_items.equipment_id
        inner join transactions on transaction_items.transaction_id = transactions.id
        where cadet_id = '$id' and type = 'issuance' and active is true");

    $select_count = DB::table('transactions')
        ->where('cadet_id', $id)
        ->whereYear('created_at', '=', date('Y'))
        ->count();
    if($select_count==0){
        $count = "0001";
    }elseif($select_count > 0 && $select_count < 10){
        $select_count = $select_count + 1;
        $count = "000" .''. $select_count;
    }elseif($select_count > 9 && $select_count < 100){
        $select_count = $select_count + 1;
        $count = "00" .''. $select_count;
    }
    $ear = date('Y') . "-"  . $id . '-' . $count;
    $cadets = Profile::where('profile_type', '=', 'Cadet')->get();

    return view('equipment.operations.report')
      ->withEquipments($equipments)
      ->withCadets($cadets)
      ->with('cadet_name', $cadet_name)
      ->with('cadet_id', $id)
      ->with('ear', $ear);
  }

  public function store_report(Request $request, $id){
    $transaction = new Transaction();
    $transaction->cadet_id = $id;
    $transaction->type = 'reported';
    $transaction->ear = $request->ear;
    $transaction->purpose = $request->purpose;
    $transaction->remarks = $request->remarks;
    $transaction->admin_id = Auth::user()->id;
    $transaction->rep_cadet_id = $request->rep_cadet_id;
    $transaction->save();

    $tran_id = '';
    $tran = Transaction::where('ear', '=', $request->ear)->first();
    if($tran){
      $tran_id = $tran->id;
    }
    $equipment_id = $request->equipment_id;
    $items = new Transaction_Item();
    $items->transaction_id = $tran_id;
    $items->equipment_id = $request->equipment_id;
    $items->save();

    DB::update("update equipments set available = true where id = '$equipment_id'");

    /*logs*/
    $log = new Log();
    $log->activity = 'Create new report equipment with EAR: '. $request->ear;
    $log->user_id = auth()->user()->id;
    $log->ip_address = request()->ip();
    $log->save();

    return redirect()->route('equipment.load.index', $id)->with('success','New report created successfully!');
  }


}
