<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PricesPost;

use App\Models\Preco;

class PricesController extends Controller
{
    public function index()
    {
        $precos = Preco::all();
        return view('admin.PricesManagement')
            ->withPrecos($precos);
    }

    public function edit(Preco $preco)
    {
        return view('prices.Edit')
            ->withPreco($preco);
    }

    public function update(Request $request, Preco $preco)
    {
        //dd($request);

        if (isset($request['preco_un_catalogo'])) {
            $preco->preco_un_catalogo = $request['preco_un_catalogo'];
        } elseif ($request['preco_un_proprio']) {
            $preco->preco_un_proprio = $request['preco_un_proprio'];
        } elseif ($request['preco_un_catalogo_desconto']) {
            $preco->preco_un_catalogo_desconto = $request['preco_un_catalogo_desconto'];
        } elseif ($request['preco_un_proprio_desconto']) {
            $preco->preco_un_proprio_desconto = $request['preco_un_proprio_desconto'];
        } elseif ($request['quantidade_desconto']) {
            $preco->quantidade_desconto = $request['quantidade_desconto'];
        }

        //dd($preco);
        $preco->save();
        return redirect()->route('Prices')
            ->with('alert-msg', 'Preço foi alterado com sucesso!')
            ->with('alert-type', 'success');
    }
}
