<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use Illuminate\Http\Request;
use App\Models\Cor;
use App\Http\Requests\ProductPost;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $listaTamanhos = ['XS', 'S', 'M', 'L', 'XL'];
        $listaCores = Cor::pluck('nome', 'codigo');

        $carrinho = $request->session()->get('carrinho', []);

        if ($carrinho != []) {
            foreach ($carrinho['items'] as $key=>$row) {
                $carrinho['items'][$key]['imagem'] = Estampa::find($row['estampa_id'])->getImagemFullUrl();
            }
        }

        return view('cart.Cart')
            ->with('pageTitle', 'Carrinho de compras')
            ->withCarrinho($carrinho)
            ->withTamanhos($listaTamanhos)
            ->withCores($listaCores);
    }

    public function store_tshirt(ProductPost $request)
    {
        $request->validated();
        $carrinho = $request->session()->get('carrinho', []);
        $key = "$request->estampa_id" . '-' . "$request->cor_codigo" . '-' . "$request->tamanho";

        if (empty($carrinho)) {
            $carrinho['precoTotal'] = 0;
            $carrinho['quantidadeItens'] = 0;
        }
        else {
            if(array_key_exists($key, $carrinho['items'])) {
                $quantidade = $carrinho['items'][$key]['quantidade'] + $request->quantidade;
                $request->session()->put("carrinho.items.$key.quantidade", $quantidade);

                return back()
                ->with('alert-msg', 'Foi adicionada uma tshirt carrinho!')
                ->with('alert-type', 'success');
            }
        }

        $carrinho['items']["$request->estampa_id" . '-' . "$request->cor_codigo" . '-' . "$request->tamanho"] = [
            'quantidade' => $request->quantidade,
            'estampa_id' => $request->estampa_id,
            'cor_codigo' => $request->cor_codigo,
            'tamanho' => $request->tamanho,
            'preco' => $request->preco,
            'subtotal' => ($request->preco * $request->quantidade),
            'nome' => Estampa::where('id', $request->estampa_id)->value('nome'),
            'imagem' => Estampa::where('id', $request->estampa_id)->value('imagem_url')
        ];

        $carrinho['precoTotal'] += $request->preco * $request->quantidade;
        $carrinho['quantidadeItens'] += 1;

        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', 'Foi adicionada uma tshirt carrinho!')
            ->with('alert-type', 'success');
    }

    public function update_tshirt(Request $request, string $index)
    {
        $carrinho = $request->session()->get('carrinho', []);
        $quantidade = $request->quantidade;
        $newIndex = $carrinho['items'][$index]['estampa_id'] . '-' . $request->cor_codigo . '-' . $request->$index;

        if ($quantidade <= 0) {
            $carrinho['quantidadeItens']--;
            $precoTotal = $carrinho['precoTotal'] - $carrinho['items'][$index]['subtotal'];
            $carrinho['precoTotal'] = $precoTotal;
            unset($carrinho['items'][$index]);

            $msg = 'T-shirt foi removida';
        } else {
            if(array_key_exists($newIndex, $carrinho['items']) && $index != $newIndex) {
                $quantidade = $carrinho['items'][$newIndex]['quantidade'] + $request->quantidade;
                $carrinho['items'][$newIndex]['quantidade'] = $quantidade;
                $carrinho['items'][$newIndex]['subtotal'] = ($carrinho['items'][$newIndex]['preco'] * $quantidade);
                $carrinho['quantidadeItens']--;
                unset($carrinho['items'][$index]);
                $request->session()->put('carrinho', $carrinho);

                return back()
                ->with('alert-msg', 'Foi adicionada uma tshirt carrinho!')
                ->with('alert-type', 'success');
            }

            $carrinho['items'][$newIndex] = $carrinho['items'][$index];
            $carrinho['items'][$newIndex]['quantidade'] = $request->quantidade;
            $carrinho['items'][$newIndex]['subtotal'] = ($carrinho['items'][$newIndex]['preco'] * $request->quantidade);
            $carrinho['items'][$newIndex]['cor_codigo'] = $request->cor_codigo;
            $carrinho['items'][$newIndex]['tamanho'] = $request->$index;

            if($index != $newIndex) {
                unset($carrinho['items'][$index]);
            }

            $msg = 'T-shirt foi alterada';
        }
        $request->session()->put('carrinho', $carrinho);

        return back()
            ->with('alert-msg', $msg)
            ->with('alert-type', 'success');
    }

    public function destroy_tshirt(Request $request, string $index)
    {
        $carrinho = $request->session()->get('carrinho', []);
        if (array_key_exists($index, $carrinho['items'])) {
            $carrinho['quantidadeItens']--;
            $carrinho['precoTotal'] -= $carrinho['items'][$index]['subtotal'];
            unset($carrinho['items'][$index]);

            $request->session()->put('carrinho', $carrinho);

            return back()
                ->with('alert-msg', 'A T-shirt foi removida')
                ->with('alert-type', 'success');
        }
        return back()
            ->with('alert-msg', 'A T-shirt já não estava no carrinho!')
            ->with('alert-type', 'warning');
    }

    public function store(Request $request)
    {
        dd(
            'Place code to store the shopping cart / transform the cart into a sale',
            $request->session()->get('carrinho')
        );
    }
}
