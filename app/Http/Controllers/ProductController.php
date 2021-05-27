<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use App\Models\Cor;
use App\Models\Preco;
use App\Models\Categoria;
use App\Models\Tshirt;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Estampa $estampa)
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

    public function store(Request $request)
    {/*
        $validated = $request->validate([
            'estampa_id' =>  'required|exists:estampas,id',
            'cor_codigo' =>  'required|exists:cores,codigo',
            'tamanho' =>     'required|in:XS,S,M,L,XL',
            'quantidade' =>  'required|integer|min:1',
            'preco_un' =>    'nullable',
        ], [  // Custom Error Messages
            'cor_codigo.required' => 'Deve selecionar uma cor para a T-Shirt',
            'tamanho.required' => 'Deve escolher o tamanho da T-Shirt',
            'quantidade.required' => 'Tem que inserir um valor para a quantidade',
            'quantidade.integer' => 'O valor tem que ser um número inteiro',
        ]);
        // If something is not valid, execution is interrupted.
        // Remaining code is only executed if validation passes
        Tshirt::create($validated);
        */
    }
}
