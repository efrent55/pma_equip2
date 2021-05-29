<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $count_serviceable = DB::table('equipments')->where('status', 'SERVICEABLE')->count();
        $count_unserviceable = DB::table('equipments')->where('status', 'UNSERVICEABLE')->count();
        $count_turnedintosao = DB::table('equipments')->where('status', 'TURNED IN TO SAO')->count();
        return view('home')
            ->with('serviceable', $count_serviceable)
            ->with('unserviceable', $count_unserviceable)
            ->with('turnedintosao', $count_turnedintosao);
    }
}
