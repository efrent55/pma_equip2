<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Equipment;

class ReportController extends Controller
{
    public function load_equipment_status(Request $request){
        $equipments = Equipment::where('status', strtoupper($request->report))->get();
        return view('equipment.report.equipment')
          ->with('report', $request->report)
          ->withEquipments($equipments);
    }

    public function load_inventory_status(Request $request){
      if($request->report == 'In Storage'){
        $param = "available = true";
      } elseif($request->report == 'Issued'){
        $param = "available = false";
      } elseif($request->report == 'Lost or Damage'){
        $param = "transactions.type='reported' and transaction_items.active = true";
      }

      $equipments = DB::select("select distinct equipments.*, profiles.sn,
            profiles.firstname, profiles.middlename, profiles.lastname, profiles.extname
              from equipments
            left join transaction_items on
              equipments.id = transaction_items.equipment_id
            left join transactions on
              transaction_items.transaction_id = transactions.id
            left join profiles on
              transactions.cadet_id = profiles.user_id
            where " . $param);

      return view('equipment.report.inventory')
        ->with('report', $request->report)
        ->withEquipments($equipments);
  }
}
