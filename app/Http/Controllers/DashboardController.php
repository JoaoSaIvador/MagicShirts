<?php

namespace App\Http\Controllers;

use App\Models\Encomenda;
use App\Models\Categoria;
use App\Models\Estampa;
use App\Models\Cor;
use App\Models\Tshirt;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        if (auth()->user()->tipo == 'F') {
            return view('home.dashboard');
        }

        $estampaPopular = Estampa::join('tshirts', 'estampas.id', 'tshirts.estampa_id')->groupBy('estampas.id')
                            ->orderByRaw('SUM(tshirts.quantidade) DESC')->limit(1)
                            ->select('estampas.nome', Tshirt::raw('SUM(tshirts.quantidade) as quantidade'))->get();

        $categoriaPopular = Categoria::join('estampas', 'categorias.id', 'estampas.categoria_id')
                            ->join('tshirts', 'estampas.id', 'tshirts.estampa_id')->groupBy('categorias.id')
                            ->orderByRaw('SUM(tshirts.quantidade) DESC')->limit(1)
                            ->select('categorias.nome', Tshirt::raw('SUM(tshirts.quantidade) as quantidade'))->get();

        $corPopular = Cor::join('tshirts', 'cores.codigo', 'tshirts.cor_codigo')->groupBy('cores.codigo')
                        ->orderByRaw('SUM(tshirts.quantidade) DESC')->limit(1)
                        ->select('cores.nome', Tshirt::raw('SUM(tshirts.quantidade) as quantidade'))->get();

        $tamanhoPopular = Tshirt::groupBy('tamanho')->orderByRaw('SUM(quantidade) DESC')->limit(1)
                            ->select('tamanho', Tshirt::raw('SUM(quantidade) as quantidade'))->get();

        $pagamentoPopular = Encomenda::groupBy('tipo_pagamento')->orderByRaw('count(tipo_pagamento) DESC')->limit(1)
                            ->select('tipo_pagamento', Encomenda::raw('count(tipo_pagamento) as quantidade'))->get();

        $encomendas = Encomenda::groupBy('estado')->select('estado', Encomenda::raw('count(estado) as quantidade'))->get();
        $utilizadores = User::groupBy('tipo')->selectRaw('count(tipo) as quantidade')->get();
        $mediaMes = Encomenda::selectRaw('round((sum(preco_total)/count(DISTINCT year(data),month(data))),2) as mediaMes')->get();
        $mediaMes[0]['mediaMes'] = number_format($mediaMes[0]['mediaMes'], 2, ',', ' ');
        $mediaAno = Encomenda::selectRaw('round((sum(preco_total)/count(DISTINCT year(data))),2) as mediaAno')->get();
        $mediaAno[0]['mediaAno'] = number_format($mediaAno[0]['mediaAno'], 2, ',', ' ');
        $lucroMes = Encomenda::groupByRaw('date_format(data, "%Y-%m")')->select(Encomenda::raw('date_format(data, "%Y-%m") as data'), Encomenda::raw('round(AVG(preco_total),2) as media'))->get();

        $card = [$estampaPopular, $categoriaPopular, $corPopular, $tamanhoPopular, $pagamentoPopular, $mediaMes, $mediaAno];

        $graph[] = [
            'label' => array(),
            'data'  => array(),
        ];

        foreach ($encomendas as $encomenda) {
            $graph[0]['label'][] =  $encomenda['estado'];
            $graph[0]['data'][]  = $encomenda['quantidade'];
        }
        foreach ($utilizadores as $utilizador) {
            $graph[1]['data'][]  = $utilizador['quantidade'];
        }
        foreach ($lucroMes as $lucro) {
            $graph[2]['label'][] =  $lucro['data'];
            $graph[2]['data'][]  = $lucro['media'];
        }

        return view('home.Info')
        ->withCard($card)
        ->withGraph($graph);
    }

}
