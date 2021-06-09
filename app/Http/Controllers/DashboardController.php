<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('home.Dashboard');
    }

    public function view_dashboard()
    {
        return view('home.Info');
    }

}
