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
        $categoria = $request->query('categoria_id', null);

        $listaEstampas = Estampa::where('categoria_id', $categoria)->whereNull('cliente_id')->get();

        //dd($precoEstampa->preco_un_catalogo);
        return view('catalogue.Catalogue')
            ->withPageTitle('Catalogo')
            ->withEstampas($listaEstampas)
            ->withCategoria($categoria)
            ->withCategorias($listaCategorias);
    }
}
