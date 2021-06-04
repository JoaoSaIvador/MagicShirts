<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Encomenda;
use App\Models\Estampa;
use App\Models\User;
use App\Models\Cor;

use App\Http\Requests\OrderPost;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $filtro = $request->except('_token');;
        //$key = array_keys($data);

        if (!empty($filtro['filtro'])) {
            //dd($filtro['filtro']);
            $listaEncomendas = Encomenda::where('estado', $filtro['filtro'])->paginate(20);
        }
        else{
            $listaEncomendas = Encomenda::orderBy('id', 'desc')->paginate(20);
        }
        //$listaEncomendas = Encomenda::where('cliente_id', 511)->paginate(20);

        //$listaEncomendas = Encomenda::where('data', "2019-12-03")->paginate(20);

        foreach ($listaEncomendas as $encomenda) {
            $listaTshirts[$encomenda['id']] = $encomenda->tshirts;
        }

        //dd($listaEstampas);

        return view('orders.ClientFilterForm')
            ->withPageTitle('Encomendas')
            ->withEncomendas($listaEncomendas);
    }

    public function view_details(Encomenda $encomenda)
    {
        $listaTshirts = $encomenda->tshirts;
        $user = User::where('id', $encomenda->cliente_id)->value('name');

        if (is_null($encomenda->recibo_url)) {
            $encomenda->recibo_url = "Não possui recibo";
        }

        foreach ($listaTshirts as $tshirt) {
            $listaEstampas[] = Estampa::where('id', $tshirt->estampa_id)->value('nome');
            $listaCores[] = Cor::where('codigo', $tshirt->cor_codigo)->value('nome');
        }
        //dd($listaEstampas);

        return view('orders.Details-order')
            ->withPageTitle('Detalhes')
            ->withUser($user)
            ->withEncomenda($encomenda)
            ->withTshirts($listaTshirts)
            ->withEstampas($listaEstampas)
            ->withCores($listaCores);
    }

    public function update(OrderPost $request, Encomenda $encomenda)
    {
        $encomenda->fill($request->validated());
        $encomenda->save();
        return redirect()->route('Orders')
            ->withPageTitle('Encomendas');
    }

    public function filter($filtro)
    {
        $data;
        switch($filtro)
        {
            case 'nome':
                //$data = select ordenado por nome
                break;
            case 'id':
                // $data = select ordenado por id

                break;
        }
    }
    //return view('orders.Details-order')-> with($data);
}
