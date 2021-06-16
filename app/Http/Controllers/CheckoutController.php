<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use Illuminate\Http\Request;
use App\Http\Requests\CheckoutPost;
use App\Models\Tshirt;
use App\Notifications\OrderCreated;
Use \Carbon\Carbon;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $carrinho = $request->session()->get('carrinho', []);

        if(empty($carrinho['items'])) {
            abort(401);
        }

        return view('checkout.Checkout')
            ->withPageTitle('Checkout')
            ->with('carrinho', session('carrinho'))
            ->with('user', auth()->user());
    }

    public function finalize_order(CheckoutPost $request) {

        $request->validated();
        $carrinho = $request->session()->get('carrinho', []);
        $data = Carbon::now();

        $encomenda = new Encomenda;
        $encomenda->estado = 'pendente';
        $encomenda->cliente_id = auth()->user()->id;
        $encomenda->data = $data->toDateString();
        $encomenda->preco_total = $carrinho['precoTotal'];
        $encomenda->notas = $request->notas;
        $encomenda->nif = $request->nif;
        $encomenda->endereco = $request->morada;
        $encomenda->tipo_pagamento = $request->metodo_pagamento;
        $encomenda->ref_pagamento = $request->ref_pagamento;
        $encomenda->save();

        foreach($carrinho['items'] as $item) {
            $tshirt = new Tshirt;
            $tshirt->encomenda_id = $encomenda->id;
            $tshirt->estampa_id = $item['estampa_id'];
            $tshirt->cor_codigo = $item['cor_codigo'];
            $tshirt->tamanho = $item['tamanho'];
            $tshirt->quantidade = $item['quantidade'];
            $tshirt->preco_un = $item['preco_un'];
            $tshirt->subtotal = $item['subtotal'];
            $tshirt->save();
        }

        $user = auth()->user();
        $user->notify(new OrderCreated());

        $request->session()->forget('carrinho');
        return redirect()->route('Home')
            ->with('alert-msg', "Encomenda criada")
            ->with('alert-type', 'success');
    }
}
