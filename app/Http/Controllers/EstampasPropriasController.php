<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EstampasPropriasController extends Controller
{
    public function index()
    {
        return view('estampasProprias.index')->with('pageTitle', 'Estampas Costumizadas');
    }
}