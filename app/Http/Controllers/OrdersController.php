<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PDF;

use App\Models\Encomenda;
use App\Models\Estampa;
use App\Models\User;
use App\Models\Cor;
use App\Notifications\OrderShipped;

use App\Http\Requests\OrderPost;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $filtro = $request->except('_token');;

        if (!empty($filtro['filtro'])) {
            $listaEncomendas = Encomenda::where('estado', $filtro['filtro'])->select('id', 'nome', 'estado', 'preco_total', 'data')->paginate(20);
        } else {
            if (auth()->user()->tipo == 'F') {
                $listaEncomendas = Encomenda::whereIn('estado', ['pendente', 'paga'])->orderBy('id', 'desc')->select('id', 'estado', 'preco_total', 'data')->paginate(20);
            } else {
                $listaEncomendas = Encomenda::orderBy('id', 'desc')->paginate(20);
            }
        }

        return view('orders.ClientFilterForm')
            ->withEncomendas($listaEncomendas)
            ->withFiltro('cliente');
    }

    public function view_details(Encomenda $encomenda)
    {

        $user = User::find($encomenda->cliente_id);


        $listaTshirts = $encomenda->tshirts;

        if (is_null($encomenda->recibo_url)) {
            $encomenda->recibo_url = "Não possui recibo";
        }

        foreach ($listaTshirts as $tshirt) {
            $listaEstampas[] = [
                'nome' => Estampa::where('id', $tshirt->estampa_id)->withTrashed()->value('nome'),
                'imagem_url' => Estampa::withTrashed()->find($tshirt->estampa_id)->getImagemFullUrl(),
            ];
            $listaCores[] = Cor::where('codigo', $tshirt->cor_codigo)->withTrashed()->value('nome');
        }
        //dd($listaEstampas);

        return view('orders.Details-order')
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

        if ($request->estado == 'fechada') {
            $listaTshirts = $encomenda->tshirts;
            $user = User::where('id', $encomenda->cliente_id)->value('name');

            foreach ($listaTshirts as $tshirt) {
                $listaEstampas[] = Estampa::where('id', $tshirt->estampa_id)->value('nome');
                $listaCores[] = Cor::where('codigo', $tshirt->cor_codigo)->value('nome');
            }

            $data = [
                'user'           => $user,
                'nif'            => $encomenda->nif,
                'endereco'       => $encomenda->endereco,
                'tipo_pagamento' => $encomenda->tipo_pagamento,
                'ref_pagamento'  => $encomenda->ref_pagamento,
                'tshirts'        => $listaTshirts,
                'estampas'       => $listaEstampas,
                'cores'          => $listaCores,
                'preco_total' => $encomenda->preco_total

            ];

            $pdf = PDF::loadView('pdf.Receipt', $data);
            $content = $pdf->download()->getOriginalContent();
            Storage::put('public/recibos/' . $encomenda->id . '.pdf', $content);

            $encomenda->recibo_url = $encomenda->id . '.pdf';
            $encomenda -> save();
            $recibo = $encomenda->recibo_url;

            $user = User::where('id', $encomenda->cliente_id)->get();
            $user->each->notify(new OrderShipped($recibo));
        }

        return redirect()->route('Orders');
    }

    public function filter($Filter, Request $request)
    {

        // dd($request->input('valor'));
        switch ($Filter) {
            case 'cliente':
                $listaEncomendas = Encomenda::where('cliente_id', $request->input('valor'))->select('id', 'estado', 'preco_total', 'data')->paginate(20);
                return view('orders.ClientFilterForm')->withEncomendas($listaEncomendas)->withFiltro('cliente');
                break;
            case 'estado':
                $listaEncomendas = Encomenda::where('estado', $request->input('valor'))->select('id', 'estado', 'preco_total', 'data')->paginate(20);
                return view('orders.StateFilterForm')->withEncomendas($listaEncomendas)->withFiltro('estado');
                break;
            case 'data':
                $listaEncomendas = Encomenda::orderBy('data', $request->input('valor'))->paginate(20);
                return view('orders.DateFilterForm')->withEncomendas($listaEncomendas)->withFiltro('data');
                break;
            default:
                $listaEncomendas = Encomenda::orderBy('id', 'desc')->paginate(20);
                return view('orders.ClientFilterForm')->withEncomendas($listaEncomendas)->withFiltro('cliente');
        }
    }

    public function changefilter($Filter)
    {
        $listaEncomendas = Encomenda::orderBy('id', 'desc')->paginate(20);
        //dd($Filter);
        switch ($Filter) {
            case 'data':
                return view('orders.DateFilterForm')->withEncomendas($listaEncomendas)->withFiltro('data');
                break;
            case 'estado':
                return view('orders.StateFilterForm')->withEncomendas($listaEncomendas)->withFiltro('estado');
                break;
            default:
                return view('orders.ClientFilterForm')->withEncomendas($listaEncomendas)->withFiltro('cliente');
        }
    }

    public function client_history()
    {
        $user = auth()->user();
        $listaEncomendas = Encomenda::whereNotNull('cliente_id', $user->cliente->id)->select('id', 'estado', 'cliente_id', 'preco_total', 'data')->get();

        return view('orders.clientHistory')
            ->withPageTitle('Histórico de Encomendas')
            ->with('user', auth()->user())
            ->withEncomendas($listaEncomendas);
    }
}
