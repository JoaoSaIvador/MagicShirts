<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Estampa;
use App\Models\Categoria;
use App\Models\Cor;
use App\Models\Preco;

class CatalogueController extends Controller
{
    public function index(Request $request)
    {
        $listaCategorias = Categoria::pluck('nome', 'id');
        $categoria = $request->query('categoria_id', 1);
        //$categoria = $request->categoria_id ?? 1;

        $listaEstampas = Estampa::where('categoria_id', $categoria)->get();
        $listaTamanhos = ['XS', 'S', 'M', 'L', 'XL'];
        $listaCores = Cor::pluck('nome', 'codigo');
        $precoEstampa = Preco::find(1);

        //dd($precoEstampa->preco_un_catalogo);
        return view('catalogue.Catalogue')
            ->withPageTitle('Catalogo')
            ->withEstampas($listaEstampas)
            ->withCategoria($categoria)
            ->withCategorias($listaCategorias)
            ->withCores($listaCores)
            ->withTamanhos($listaTamanhos)
            ->withPreco($precoEstampa);
    }
}
