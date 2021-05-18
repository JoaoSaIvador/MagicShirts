<?php

namespace App\Http\Controllers;

use App\Models\Tshirt;
use App\Models\Estampa;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        //dd(session('carrinho') ?? []);
        return view('orders.Cart')
            ->withPageTitle('Carrinho')
            ->withCarrinho(session('carrinho') ?? []);
    }

    public function store(Request $request, Tshirt $tshirt)
    {
        $carrinho = $request->session()->get('carrinho', []);
        $quantidade = ($carrinho[$tshirt->id]['quantidade'] ?? 0) + 1;
        $carrinho[$tshirt->id] = [
            'id' => $tshirt->id,
            'quantidade' => $quantidade,
            'id_encomenda' => $tshirt->id_encomenda,
            'estampa_id' => $tshirt->estampa_id,
            'cor_codigo' => $tshirt->cor_codigo,
            'tamanho' => $tshirt->tamanho,
            'preco_un' => $tshirt->preco_un
        ];
        $request->session()->put('carrinho', $carrinho);
    }
}
