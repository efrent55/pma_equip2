<?php

namespace App\Http\Controllers\Equipment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Equipment;
use App\Account;
use App\Account_Keyword;
use App\Log;
use QRCode;

/* use App\User;
use App\Role;
use App\Profile; */

class ManagementController extends Controller
{
    public function index(){
        $accounts = Account::orderBy('id', 'asc')->get();
        $keywords = Account_Keyword::orderBy('commonname', 'asc')->get();
        $equipments = Equipment::orderBy('description', 'asc')->get();
        return view('equipment.management.index')
          ->withAccounts($accounts)
          ->withKeywords($keywords)
          ->withEquipments($equipments);
    }

    public function create(){
        $keywords = Account_Keyword::orderBy('commonname', 'asc')->get();
        return view('equipment.management.create')
          ->withKeywords($keywords);
    }

    public function store(Request $request){
      $this->validate($request, [
        'qr_code' => 'unique:equipments',
        'property_number' => 'unique:equipments',
        'serial_number' => 'unique:equipments'
      ]);

      $equipment = new Equipment();
      $equipment->property_number = $request->property_number;
      $equipment->serial_number = $request->serial_number;
      $equipment->description = $request->description;
      $equipment->unit_measure = $request->unit_measure;
      $equipment->unit_value = $request->unit_value;
      $equipment->date_acquired = $request->date_acquired;
      $equipment->keyword_id = $request->classification;
      $equipment->status = $request->status;
      $qrcode = str_random(10);
      $equipment->qr_code = $qrcode;
      $qrcode_file = 'qrcodes/'.$qrcode.'.png';
      $qr = QRCode::text($qrcode)
        ->setSize(10)
        ->setMargin(2)
        ->setOutfile($qrcode_file)
        ->png();
      $equipment->qrcode_file = $qrcode_file;
      $equipment->save();

      /*logs*/
      $log = new Log();
      $log->activity = 'Created equipment with QR Code: '. $qrcode;
      $log->user_id = auth()->user()->id;
      $log->ip_address = request()->ip();
      $log->save();
      return redirect()->route('management.index')
        ->with('success', "New Equipment added successfully!");
    }

    public function update(Request $request, $id){
      DB::update("update equipments set
        property_number = '$request->property_number',
        serial_number = '$request->serial_number',
        description = '$request->description',
        unit_measure = '$request->unit_measure',
        unit_value = '$request->unit_value',
        date_acquired = '$request->date_acquired',
        keyword_id = '$request->classification',
        status = '$request->status'
        where id = '$id'");

      /*logs*/
      $log = new Log();
      $log->activity = 'Updated equipment with ID: '. $id;
      $log->user_id = auth()->user()->id;
      $log->ip_address = request()->ip();
      $log->save();
      return redirect()->route('management.index')
        ->with('success', "Equipment updated successfully!");
    }

    public function store_classification(Request $request){

      $keyword = new Account_Keyword();
      $keyword->account_id = $request->account;
      $keyword->commonname = $request->commonname;
      $keyword->save();

      /*logs*/
      $log = new Log();
      $log->activity = 'Created Classification: '. $request->commonname;
      $log->user_id = auth()->user()->id;
      $log->ip_address = request()->ip();
      $log->save();
      return redirect()->back()->with('success', "Equipment Classification created successfully!");
    }

    public function update_classification(Request $request, $id) {
      DB::update("update account_keywords set
        commonname = '$request->commonname',
        account_id = '$request->account' where id='$id'");

      /*logs*/
      $log = new Log();
      $log->activity = 'Updated classification with ID: '. $id;
      $log->user_id = auth()->user()->id;
      $log->ip_address = request()->ip();
      $log->save();
      return redirect()->back()->with('success', "Equipment Classification updated successfully!");
    }

    public function load_classification(){
      $accounts = Account::orderBy('id', 'asc')->get();
      $keywords = Account_Keyword::orderBy('commonname', 'asc')->get();
      $commonnames = DB::table('accounts')
        ->join('account_keywords', 'accounts.id', '=', 'account_keywords.account_id')
        ->get();
      return view('equipment.management.classification')
        ->withAccounts($accounts)
        ->withKeywords($keywords)
        ->withCommonnames($commonnames);
    }

    public function storex(Request $request){
        $this->validate($request, [
            'username' => 'required|max:255|unique:users'
          ]);

        $user = new User();
        $user->username = $request->username;
        //$user->email = $request->email;
        $user->api_token = str_random(60);
        $user->password = bcrypt('secret');

        if ($user->save()) {
            $profile = new Profile();
            $profile->firstname = $request->fname;
            $profile->middlename = $request->mname;
            $profile->lastname = $request->sname;
            $profile->extname = $request->ename;
            $profile->gender = $request->gender;
            $profile->birthdate = $request->birthdate;
            $profile->sn = $request->sn;
            $profile->profile_type = $request->type;
            $user->profiles()->save($profile);
            //$user->offices()->sync($request->offices);

            /* return redirect()->route('users.show', $user->id); */
            return redirect()->route('users.index');
        } else {
          //Session::flash('danger', 'Sorry a problem occurred while creating this user.');
          return redirect()->route('users.create');
        }
    }
/*
    public function update(Request $request, $id)
    {
      $this->validate($request, [
        'username' => 'required|max:255|unique:users,email,'.$id,
        'email' => 'required|email|unique:users,email,'.$id
      ]);

      $user = User::findOrFail($id);
      $user->username = $request->username;
      $user->email = $request->email;

      if ($user->save()) {
        $personnel = Personnel::where('user_id', $id)->first();
        $personnel->fname = $request->fname;
        $personnel->mname = $request->mname;
        $personnel->sname = $request->sname;
        $personnel->ename = $request->ename;
        $personnel->gender = $request->gender;
        $personnel->personnel_type = $request->type;
        $personnel->employment_status = $request->status;
        $user->personnels()->save($personnel);

        $pre = $user->offices()->pluck('office_id');
        if($pre->count() == 0){
          $user->offices()->sync($request->offices);
        } else {
          $user->offices_present()->whereNotIn('office_id', $request->offices)->update(['present' => 0 , 'office_user.updated_at' => date('Y-m-d H:i:s')]);
          $user->offices_unpresent()->whereIn('office_id', $request->offices)->update(['present' => 1 , 'office_user.updated_at' => date('Y-m-d H:i:s')]);
          $diff = collect($request->offices)->diff($pre);
          $user->offices()->syncWithoutDetaching($diff);
        }
        return redirect()->route('users.show', $id);
      } else {
        return redirect()->route('users.index');
      }
    }

    public function edit($id)
    {
      $offices = Office::orderBy('office', 'asc')->get();
      $user = User::where('id', $id)->first();
      return view('manage.users.edit')->withUser($user)->withOffices($offices);
    }
 */
   /*  public function show($id)
    {
      $user = User::where('id', $id)->first();
      return view('manage.users.show')->withUser($user);
    } */
}
