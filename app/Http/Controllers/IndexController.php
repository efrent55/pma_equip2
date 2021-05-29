<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index(){
        $count_serviceable = DB::table('equipments')->where('status', 'SERVICEABLE')->count();
        $count_unserviceable = DB::table('equipments')->where('status', 'UNSERVICEABLE')->count();
        $count_turnedintosao = DB::table('equipments')->where('status', 'TURNED IN TO SAO')->count();
        $count_instorage = DB::table('equipments')->where('available', true)->count();
        $count_issued = DB::table('transaction_items')
          ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
          ->where('type', 'issuance')->where('active', true) ->count();
        $count_lostdamage = DB::table('transaction_items')
          ->join('transactions', 'transaction_items.transaction_id', '=', 'transactions.id')
          ->where('type', 'reported')->where('active', true) ->count();
        return view('index')
            ->with('count_serviceable', $count_serviceable)
            ->with('count_unserviceable', $count_unserviceable)
            ->with('count_turnedintosao', $count_turnedintosao)
            ->with('count_instorage', $count_instorage)
            ->with('count_issued', $count_issued)
            ->with('count_lostdamage', $count_lostdamage);
    }

    public function login_log()
    {
        /* \LogActivity::addToLog('My Testing Add To Log.');
        dd('log insert successfully.'); */
    }
}
