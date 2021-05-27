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

    public function view_product(Estampa $estampa)
    {
        $listaCores = Cor::pluck('nome', 'codigo');
        $precoEstampa = Preco::find(1);
        $listaTamanhos = ['XS', 'S', 'M', 'L', 'XL'];
        $categoria = Categoria::where('id', $estampa->categoria_id)->value('nome');

        if (is_null($categoria)) {
            $categoria = "Sem Categoria";
        }

        return view('product.Product')
            ->withPageTitle('Produto')
            ->withEstampa($estampa)
            ->withCores($listaCores)
            ->withTamanhos($listaTamanhos)
            ->withPreco($precoEstampa)
            ->withCategoria($categoria);
    }
}
