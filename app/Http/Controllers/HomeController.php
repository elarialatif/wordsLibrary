<?php

namespace App\Http\Controllers;

use App\Helper\UsersTypes;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role==UsersTypes::SUPERADMIN){
            return view('superadmin.home');
        }
        else{
            return view('home');
        }

    }
}
