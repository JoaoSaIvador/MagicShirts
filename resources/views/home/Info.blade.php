@extends('home.dashboard')
@section('title', 'Estatísticas')
@section('adminContent')
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Ganhos (Mensalmente)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{$card[5][0]['mediaMes']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-calendar fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Ganhos (Anualmente)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{$card[6][0]['mediaAno']}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-usd fa-3x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Ganhos</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="myAreaChart" style="display: block; width: 630px; height: 320px;" width="630" height="320" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Tipo de Utilizadores</h6>
                </div>
                <div class="card-body">
                    <div class="chart-pie pt-4 pb-2"><div class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand"><div class=""></div></div><div class="chartjs-size-monitor-shrink"><div class=""></div></div></div>
                        <canvas id="myAreaDoughnut" width="282" height="245" style="display: block; width: 282px; height: 245px;" class="chartjs-render-monitor"></canvas>
                    </div>
                    <div class="mt-4 text-center small">
                        <span class="mr-2">
                            <i class="fa fa-circle" style="color: #ff8533"></i>Clientes
                        </span>
                        <span class="mr-2">
                            <i class="fa fa-circle" style="color: #ffff00"></i>Funcionários
                        </span>
                        <span class="mr-2">
                            <i class="fa fa-circle" style="color: #ff0000"></i>Administradores
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-dark">Popular</h6>
                </div>
                <div class="card-body">
                    <h4 class="fs-6 font-weight-bold">Estampa mais usada<span class="float-right">Em {{$card[0][0]['quantidade']}} T-shirts</span></h4>
                    <div class="mb-4">
                        <p class="font-weight-normal">{{$card[0][0]['nome']}}</p>
                    </div>
                    <h4 class="fs-6 font-weight-bold">Categoria mais usada<span class="float-right">Em {{$card[1][0]['quantidade']}} T-shirts</span></h4>
                    <div class="mb-4">
                        <p class="font-weight-normal">{{$card[1][0]['nome']}}</p>
                    </div>
                    <h4 class="fs-6 font-weight-bold">Cor mais usada<span class="float-right">Em {{$card[2][0]['quantidade']}} T-shirts</span></h4>
                    <div class="mb-4">
                        <p class="font-weight-normal">{{$card[2][0]['nome']}}</p>
                    </div>
                    <h4 class="fs-6 font-weight-bold">Tamanho mais usado<span class="float-right">Em {{$card[3][0]['quantidade']}} T-shirts</span></h4>
                    <div class="mb-4">
                        @if ($card[3][0]['tamanho'] == 'XS')
                            <p class="font-weight-normal">Extra pequeno</p>
                        @elseif ($card[3][0]['tamanho'] == 'S')
                            <p class="font-weight-normal">Pequeno</p>
                        @elseif ($card[3][0]['tamanho'] == 'M')
                            <p class="font-weight-normal">Médio</p>
                        @elseif ($card[3][0]['tamanho'] == 'L')
                            <p class="font-weight-normal">Grande</p>
                        @else
                            <p class="font-weight-normal">Extra Grande</p>
                        @endif
                    </div>
                    <h4 class="fs-6 font-weight-bold">Tipo de pagamento mais usado<span class="float-right">Em {{$card[4][0]['quantidade']}} encomendas</span></h4>
                    <div class="mb-n4">
                        <p class="font-weight-normal">{{$card[4][0]['tipo_pagamento']}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-6">
            <div class="card shadow mb-4">
                <div
                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-dark">Estado da Encomenda</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    var graph1 = @json($graph[0]);
    var graph2 = @json($graph[1]);
    var graph3 = @json($graph[2]);
</script>
<script src="{{asset('js/AreaChart.js')}}"></script>
<script src="{{asset('js/PieChart.js')}}"></script>
<script src="{{asset('js/BarChart.js')}}"></script>
@endsection
