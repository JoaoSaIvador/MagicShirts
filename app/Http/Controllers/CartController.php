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
        $qtd = ($carrinho[$tshirt->id]['qtd'] ?? 0) + 1;
        $carrinho[$tshirt->id] = [
            'id' => $tshirt->id,
            'quantidade' => $qtd,
            'id_encomenda' => $tshirt->id_encomenda,
            'estampa_id' => $tshirt->estampa_id,
            'cor_codigo' => $tshirt->cor_codigo,
            'tamanho' => $tshirt->tamanho,
            'preco_un' => $tshirt->preco_un
        ];
        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', 'Foi adicionada uma tshirt carrinho! Quantidade de inscrições = ' .  $qtd)
            ->with('alert-type', 'success');
    }

    public function update_tshirt(Request $request, Tshirt $tshirt)
    {
        $carrinho = $request->session()->get('carrinho', []);
        $qtd = $carrinho[$tshirt->id]['qtd'] ?? 0;
        $qtd += $request->quantidade;
        if ($request->quantidade < 0) {
            $msg = 'Foram removidas ' . -$request->quantidade . ' tshirts! Quantidade de tshirts atuais = ' .  $qtd;
        } elseif ($request->quantidade > 0) {
            $msg = 'Foram adicionadas ' . $request->quantidade . ' tshirts! Quantidade de tshirts atuais = ' .  $qtd;
        }
        if ($qtd <= 0) {
            unset($carrinho[$tshirt->id]);
            $msg = 'Foram removidas todas as tshirts';
        } else {
            $carrinho[$tshirt->id] = [
                'id' => $tshirt->id,
                'quantidade' => $qtd,
                'id_encomenda' => $tshirt->id_encomenda,
                'estampa_id' => $tshirt->estampa_id,
                'cor_codigo' => $tshirt->cor_codigo,
                'tamanho' => $tshirt->tamanho,
                'preco_un' => $tshirt->preco_un
            ];
        }
        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', $msg)
            ->with('alert-type', 'success');
    }

    public function destroy_tshirt(Request $request, Tshirt $tshirt)
    {
        $carrinho = $request->session()->get('carrinho', []);
        if (array_key_exists($tshirt->id, $carrinho)) {
            unset($carrinho[$tshirt->id]);
            $request->session()->put('carrinho', $carrinho);
            return back()
                ->with('alert-msg', 'Foram removidas todas tshirts')
                ->with('alert-type', 'success');
        }
        return back()
            ->with('alert-msg', 'A T-shirt já não estava no carrinho!')
            ->with('alert-type', 'warning');
    }

    public function destroy(Request $request)
    {
        $request->session()->forget('carrinho');
        return back()
            ->with('alert-msg', 'Carrinho foi limpo!')
            ->with('alert-type', 'danger');
    }
}
