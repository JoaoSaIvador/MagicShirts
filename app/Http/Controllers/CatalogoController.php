<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Estampa;

class CatalogoController extends Controller
{
    public function index(Request $request)
    {
        $listaEstampas = Estampa::all();
        //dd($estampas);
        
        return view('catalogo.index', compact('listaEstampas'));
    }
}