<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendHomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];

        if (Auth::user()->can('admin') === true)
        {
            $data['admin'] = 'admin test';
        }

        if (Auth::user()->can('general') === true)
        {
            $data['general'] = 'general test';
        }

        return view('backend.home', $data);
    }
}
