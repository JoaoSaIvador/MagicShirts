<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estampa;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $listaEstampas = Estampa::whereNull('cliente_id')->limit(10)->get()->random(10);
        //dd($listaEstampas);
        return view('home.index')->withPageTitle('MagicShirts') ->withEstampas($listaEstampas);;
    }
}
