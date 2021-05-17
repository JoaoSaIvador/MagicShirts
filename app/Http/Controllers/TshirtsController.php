<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TshirtsController extends Controller
{
    public function index()
    {
        return view('t-shirts.index')->with('pageTitle', 'T-Shirts');
    }
}
