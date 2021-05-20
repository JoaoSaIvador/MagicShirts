<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use App\Models\Cor;
use App\Models\Preco;
use App\Models\Categoria;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Estampa $estampa)
    {
        $listaCores = Cor::pluck('nome', 'codigo');
        $precoEstampa = Preco::find(1);
        $listaTamanhos = ['XS', 'S', 'M', 'L', 'XL'];
        $categoria = Categoria::where('id', $estampa->categoria_id)->value('nome');
        //dd($categoria);
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
