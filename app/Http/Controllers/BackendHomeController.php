<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendHomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend_home');
    }
}
