<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Role;
use App\Profile;
use App\Log;

class UserController extends Controller
{
    public function index(){
        //$users = User::orderBy('id', 'asc')->paginate(10);with('personnels')->
        $users = User::orderBy('id', 'asc')->get();
        return view('manage.users.index')->withUsers($users);
    }

    public function create(){
        /* $offices = Office::orderBy('office', 'asc')->get(); */
        return view('manage.users.create')/* ->withOffices($offices) */;
    }

    public function store(Request $request){
        $this->validate($request, [
            'username' => 'required|max:255|unique:users'
          ]);

        $user = new User();
        $user->username = $request->username;
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
            $profile->coy = $request->coy;
            $user->profiles()->save($profile);

            /*logs*/
            $log = new Log();
            $log->activity = 'User: '. $user->username . ' created';
            $log->user_id = auth()->user()->id;
            $log->ip_address = request()->ip();
            $log->save();
            return redirect()->route('users.index')->with('success', "User account created successfully!");
        } else {
          return redirect()->route('users.index')->with('danger', "Sorry a problem occurred while creating this user.");
        }
    }

    public function update_user(Request $request, $id){
      DB::update("update users set username = '$request->username' where id = '$id'");
      DB::update("update profiles set firstname = '$request->fname',
        middlename = '$request->mname',
        lastname = '$request->sname',
        extname = '$request->ename',
        gender = '$request->gender',
        birthdate = '$request->birthdate',
        coy = '$request->coy'
        where user_id = '$id'");

        /*logs*/
        $log = new Log();
        $log->activity = 'User: '. $id . ' updated';
        $log->user_id = auth()->user()->id;
        $log->ip_address = request()->ip();
        $log->save();
        return redirect()->route('users.index')->with('success', "User updated successfully!");
    }

    public function password_reset($id){
      $password = bcrypt('secret');
      DB::update("update users set password = '$password' where id = '$id'");

      /*logs*/
      $log = new Log();
      $log->activity = 'User: '. $id . ' password';
      $log->user_id = auth()->user()->id;
      $log->ip_address = request()->ip();
      $log->save();
      return redirect()->route('users.index')->with('success', "Password Reset successfully!");
    }

    public function activation($id){
      DB::update("update users set status = 1 where id = '$id'");

      /*logs*/
      $log = new Log();
      $log->activity = 'User: '. $id . ' activated';
      $log->user_id = auth()->user()->id;
      $log->ip_address = request()->ip();
      $log->save();
      return redirect()->route('users.index')->with('success', "User Account Activated successfully!");
    }

    public function deactivation($id){
      DB::update("update users set status = 0 where id = '$id'");

      /*logs*/
      $log = new Log();
      $log->activity = 'User: '. $id . ' deactivated';
      $log->user_id = auth()->user()->id;
      $log->ip_address = request()->ip();
      $log->save();
      return redirect()->route('users.index')->with('success', "User Account Deactivated successfully!");
    }

    public function show($id)
    {
      $user = User::where('id', $id)->first();
      return view('manage.users.show')->withUser($user);
    }
}
