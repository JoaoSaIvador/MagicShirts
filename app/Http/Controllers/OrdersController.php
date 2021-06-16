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
            $listaEncomendas = Encomenda::where('estado', $filtro['filtro'])->select('id', 'nome', 'estado', 'preco_total', 'data')->paginate(20);
        }
        else{
            if (auth()->user()->tipo == 'F') {
                $listaEncomendas = Encomenda::whereIn('estado', ['pendente','paga'])->orderBy('id', 'desc')->select('id', 'estado', 'preco_total', 'data')->paginate(20);
            }
            else {
                $listaEncomendas = Encomenda::orderBy('id', 'desc')->paginate(20);
            }
            //dd($listaEncomendas);
        }
        //$listaEncomendas = Encomenda::where('cliente_id', 511)->paginate(20);

        //$listaEncomendas = Encomenda::where('data', "2019-12-03")->paginate(20);
        //dd($listaEstampas);

        return view('orders.ClientFilterForm')->withEncomendas($listaEncomendas)->withFiltro('cliente');
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
        return redirect()->route('Orders');
    }

    public function filter($Filter, Request $request)
    {
       
       // dd($request->input('valor'));
        switch($Filter)
        {
            case 'cliente':
                $listaEncomendas = Encomenda::where('estado',$request->input('valor'))->select('id', 'estado', 'preco_total', 'data')->paginate(20);
                return view('orders.ClientFilterForm')-> with($listaEncomendas)->withFiltro('cliente');
                break;
            case 'estado':
                $listaEncomendas = Encomenda::where('cliente_id',$request->input('valor'))->select('id', 'estado', 'preco_total', 'data')->paginate(20);
                return view('orders.DateFilterForm')-> with($listaEncomendas)->withFiltro('estado');
                break;
            case 'data':
                $listaEncomendas = Encomenda::orderBy('data', $request->input('valor'))->get()->paginate(20);
                return view('orders.StateFilterForm')-> with($listaEncomendas)->withFiltro('data');
                break;
            default:
                $listaEncomendas = Encomenda::orderBy('id', 'desc')->get()->paginate(20);
                return view('orders.ClientFilterForm')-> with($listaEncomendas)->withFiltro('cliente');  
        }
    }

    public function changefilter($Filter)
    {
        $listaEncomendas = Encomenda::orderBy('id', 'desc')->get()->paginate(20);
        
        switch($Filter)
        {
            case 'estado':
                return view('orders.DateFilterForm')-> with($listaEncomendas)->withFiltro('estado');
                break;
            case 'data':
                return view('orders.StateFilterForm')-> with($listaEncomendas)->withFiltro('data');
                break;
            default:
                return view('orders.ClientFilterForm')-> with($listaEncomendas)->withFiltro('cliente');  
        }   
    }
    
}
