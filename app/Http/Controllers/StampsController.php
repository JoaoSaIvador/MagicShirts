<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Estampa;
use App\Models\Categoria;

class EstampasController extends Controller
{
    public function index(Request $request)
    {
        $listaCategorias = Categoria::pluck('nome', 'id');
        $categoria = $request->query('categoria_id', 1);
        //$categoria = $request->categoria_id ?? 1;
        $listaEstampas = Estampa::where('categoria_id', $categoria)->get();

        //dd($listaEstampas);
        return view('catalogue.Catalogue')
            ->withPageTitle('Estampas')
            ->withEstampas($listaEstampas)
            ->withCategoria($categoria)
            ->withCategorias($listaCategorias);
    }
}
