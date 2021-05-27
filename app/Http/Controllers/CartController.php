<?php

namespace App\Http\Controllers;

use App\Models\Tshirt;
use App\Models\Estampa;
use Illuminate\Http\Request;
use App\Models\Cor;
use App\Http\Requests\ProductPost;

class CartController extends Controller
{
    public function index()
    {
        $listaTamanhos = ['XS', 'S', 'M', 'L', 'XL'];
        $listaCores = Cor::pluck('nome', 'codigo');

        return view('cart.Cart')
            ->with('pageTitle', 'Carrinho de compras')
            ->with('carrinho', session('carrinho') ?? [])
            ->withTamanhos($listaTamanhos)
            ->withCores($listaCores);
    }

    public function store_tshirt(ProductPost $request)
    {
        $request->validated();
        $carrinho = $request->session()->get('carrinho', []);

        if (empty($carrinho)) {
            $carrinho['precoTotal'] = 0;
            $carrinho['quantidadeItens'] = 0;
        } 
        else {
            foreach($carrinho['items'] as $key => $item) {
                if(($item['estampa_id'] == $request->estampa_id) && (strcmp($item['tamanho'], $request->tamanho) == 0) && ($item['cor_codigo'] == $request->cor_codigo)) {                 
                    $quantidade = $item['quantidade'] + $request->quantidade;
                    $request->session()->put("carrinho.items.$key.quantidade", $quantidade);

                    return back()
                    ->with('alert-msg', 'Foi adicionada uma tshirt carrinho!')
                    ->with('alert-type', 'success');
                }
            }
        } 

        $carrinho['items'][] = [
            'quantidade' => $request->quantidade,
            'estampa_id' => $request->estampa_id,
            'cor_codigo' => $request->cor_codigo,
            'tamanho' => $request->tamanho,
            'preco_un' => $request->preco_un,
            'subtotal' => ($request->preco_un * $request->quantidade),
            'nome' => Estampa::where('id', $request->estampa_id)->value('nome'),
            'imagem' => Estampa::where('id', $request->estampa_id)->value('imagem_url')
        ];

        $carrinho['precoTotal'] += $request->preco_un * $request->quantidade;
        $carrinho['quantidadeItens'] += 1;

        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', 'Foi adicionada uma tshirt carrinho!')
            ->with('alert-type', 'success');
    }

    public function update_tshirt(ProductPost $request)
    {
        $request->validate();
        $carrinho = $request->session()->get('carrinho', []);
        $quantidade = $carrinho[$request->id]['quantidade'] ?? 0;
        $quantidade += $request->quantidade;
        if ($request->quantidade < 0) {
            $msg = 'Foram removidas ' . -$request->quantidade . ' tshirts!';
        } elseif ($request->quantidade > 0) {
            $msg = 'Foram adicionadas ' . $request->quantidade . ' tshirts!';
        }
        if ($quantidade <= 0) {
            unset($carrinho[$request->id]);
            $msg = 'Foram removidas todas as tshirts';
        } else {
            $carrinho[$request->id] = [
                'id' => $request->id,
                'quantidade' => $quantidade,
                'id_encomenda' => $request->id_encomenda,
                'estampa_id' => $request->estampa_id,
                'cor_codigo' => $request->cor_codigo,
                'tamanho' => $request->tamanho,
                'preco_un' => $request->preco_un
            ];
        }
        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', $msg)
            ->with('alert-type', 'success');
    }

    public function destroy_tshirt(Request $request, int $index)
    {
        dd($index);
        $carrinho = $request->session()->get('carrinho', []);
        if (array_key_exists($index, $carrinho)) {
            unset($carrinho[$index]);
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

    public function destroy(Request $request)
    {
        $request->session()->forget('carrinho');
        return back()
            ->with('alert-msg', 'Carrinho foi limpo!')
            ->with('alert-type', 'danger');
    }
}
