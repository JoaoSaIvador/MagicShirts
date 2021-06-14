<?php

namespace App\Http\Controllers;

use App\Models\Estampa;
use Illuminate\Http\Request;
use App\Models\Cor;
use App\Models\Preco;
use App\Http\Requests\ProductPost;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $listaTamanhos = ['XS', 'S', 'M', 'L', 'XL'];
        $listaCores = Cor::pluck('nome', 'codigo');
        $carrinho = $request->session()->get('carrinho', []);

        if (!empty($carrinho['items'])) {
            foreach ($carrinho['items'] as $key => $row) {
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
        $preco = Preco::find(1);
        $estampa = Estampa::find($request->estampa_id);

        if (empty($carrinho)) {
            $carrinho['precoTotal'] = 0;
            $carrinho['quantidadeItens'] = 0;
        } else {
            if (array_key_exists($key, $carrinho['items'])) {
                $quantidade = $carrinho['items'][$key]['quantidade'] + $request->quantidade;
                $carrinho['items'][$key]['quantidade'] = $quantidade;

                if ($quantidade >= $preco['quantidade_desconto']) {
                    $oldSubtotal = $carrinho['items'][$key]['subtotal'];

                    if ($estampa['cliente_id'] != null) {
                        $precoTshirt = $preco['preco_un_proprio_desconto'];
                    } else {
                        $precoTshirt = $preco['preco_un_catalogo_desconto'];
                    }

                    $newSubtotal = $precoTshirt * $quantidade;

                    $carrinho['items'][$key]['preco_un'] = $precoTshirt;
                    $carrinho['items'][$key]['subtotal'] = $newSubtotal;
                    $carrinho['precoTotal'] -= $oldSubtotal;
                    $carrinho['precoTotal'] += $newSubtotal;
                }

                $request->session()->put('carrinho', $carrinho);
                return back()
                    ->with('alert-msg', 'Foi adicionada uma tshirt ao carrinho!')
                    ->with('alert-type', 'success');
            }
        }

        if ($request->quantidade >= $preco['quantidade_desconto']) {
            if ($estampa['cliente_id'] != null) {
                $precoTshirt = $preco['preco_un_proprio_desconto'];
            } else {
                $precoTshirt = $preco['preco_un_catalogo_desconto'];
            }
        } else {
            $precoTshirt = $request->preco;
        }

        $carrinho['items']["$request->estampa_id" . '-' . "$request->cor_codigo" . '-' . "$request->tamanho"] = [
            'quantidade' => $request->quantidade,
            'estampa_id' => $request->estampa_id,
            'cor_codigo' => $request->cor_codigo,
            'tamanho' => $request->tamanho,
            'preco_un' => $precoTshirt,
            'subtotal' => ($precoTshirt * $request->quantidade),
            'nome' => Estampa::where('id', $request->estampa_id)->value('nome'),
            'imagem' => Estampa::where('id', $request->estampa_id)->value('imagem_url')
        ];

        $carrinho['precoTotal'] += $precoTshirt * $request->quantidade;
        $carrinho['quantidadeItens'] += 1;

        $request->session()->put('carrinho', $carrinho);
        return back()
            ->with('alert-msg', 'Foi adicionada uma tshirt ao carrinho!')
            ->with('alert-type', 'success');
    }

    public function update_tshirt(Request $request, string $index)
    {
        $carrinho = $request->session()->get('carrinho', []);
        $quantidade = $request->quantidade;
        $newIndex = $carrinho['items'][$index]['estampa_id'] . '-' . $request->cor_codigo . '-' . $request->$index;
        $preco = Preco::find(1);
        $estampa = Estampa::find($request->estampa_id);

        if ($quantidade <= 0) {
            $carrinho['quantidadeItens']--;
            $precoTotal = $carrinho['precoTotal'] - $carrinho['items'][$index]['subtotal'];
            $carrinho['precoTotal'] = $precoTotal;
            unset($carrinho['items'][$index]);

            $msg = 'T-shirt foi removida';
        } else {
            if (array_key_exists($newIndex, $carrinho['items']) && $index != $newIndex) {
                $quantidade = $carrinho['items'][$newIndex]['quantidade'] + $request->quantidade;
                $carrinho['precoTotal'] -= $carrinho['items'][$index]['subtotal'];
                $carrinho['quantidadeItens']--;
            } else {
                $carrinho['items'][$newIndex] = $carrinho['items'][$index];
            }

            $carrinho['items'][$newIndex]['quantidade'] = $quantidade;
            $oldSubtotal = $carrinho['items'][$newIndex]['subtotal'];

            if ($quantidade >= $preco['quantidade_desconto']) {
                if (isset($estampa['cliente_id'])) {
                    $precoTshirt = $preco['preco_un_proprio_desconto'];
                } else {
                    $precoTshirt = $preco['preco_un_catalogo_desconto'];
                }
            } else {
                if (isset($estampa['cliente_id'])) {
                    $precoTshirt = $preco['preco_un_proprio'];
                } else {
                    $precoTshirt = $preco['preco_un_catalogo'];
                }
            }

            $newSubtotal = $precoTshirt * $quantidade;
            $carrinho['items'][$newIndex]['preco_un'] = $precoTshirt;
            $carrinho['items'][$newIndex]['subtotal'] = $newSubtotal;
            $carrinho['precoTotal'] -= $oldSubtotal;
            $carrinho['precoTotal'] += $newSubtotal;

            if ($index != $newIndex) {
                unset($carrinho['items'][$index]);
            }

            $carrinho['items'][$newIndex]['cor_codigo'] = $request->cor_codigo;
            $carrinho['items'][$newIndex]['tamanho'] = $request->$index;
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
                ->with('alert-msg', 'A T-shirt foi removida do carrinho')
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
