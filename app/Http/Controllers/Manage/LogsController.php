<?php

namespace App\Http\Controllers\Manage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogsController extends Controller
{
    public function index(){
        $logs = DB::select("select activity_logs.*,
              profiles.user_id,
              profiles.lastname,
              profiles.firstname,
              profiles.middlename
              from activity_logs inner join profiles
              on activity_logs.user_id = profiles.user_id");
        return view('manage.logs.index')
          ->withLogs($logs);
    }

}
