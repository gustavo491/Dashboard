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
        $access = DB::table('access')->get();
        $total = ['01' => 0,'02' => 0,'03' => 0,'04' => 0,'05' => 0,'06' => 0,'07' => 0,'08' => 0,'09' => 0,'10' => 0,'11' => 0,'12' => 0];

        foreach($access as $key => $data){
            $total[date('m',strtotime($data->created_at))] = $data->access;
        }

        return view('home', ['access' => $access, 'total' => $total]);
    }
}
