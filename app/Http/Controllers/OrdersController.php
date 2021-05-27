<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Encomenda;
use App\Models\Estampa;

class OrdersController extends Controller
{
    public function index()
    {
        $listaEncomendas = Encomenda::paginate(20);

        $listaTshirts = [];
        foreach ($listaEncomendas as $encomenda) {
            $listaTshirts[$encomenda['id']] = $encomenda->tshirts;
        }

        $listaEstampas = Estampa::all('id', 'nome');

        //dd($listaEstampas);

        return view('orders.Orders')
            ->withPageTitle('Encomendas')
            ->withEncomendas($listaEncomendas)
            ->withTshirts($listaTshirts)
            ->withEstampas($listaEstampas);
    }

    public function destroy(Encomenda $encomenda)
    {
        return redirect()->route('Order');
    }
}
