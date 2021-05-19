<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Estampa;
use App\Models\Categoria;
use App\Models\Cor;

class CatalogueController extends Controller
{
    public function index(Request $request)
    {
        $listaCategorias = Categoria::pluck('nome', 'id');
        $categoria = $request->query('categoria_id', 1);
        //$categoria = $request->categoria_id ?? 1;

        $listaCores = Cor::pluck('nome', 'codigo');
        
        $listaEstampas = Estampa::where('categoria_id', $categoria)->get();

        $listaTamanhos = ['XS', 'S', 'M', 'L', 'XL'];

        //dd($listaEstampas);
        return view('catalogue.Catalogue')
            ->withPageTitle('Catalogo')
            ->withEstampas($listaEstampas)
            ->withCategoria($categoria)
            ->withCategorias($listaCategorias)
            ->withCores($listaCores)
            ->withTamanhos($listaTamanhos);
    }
}