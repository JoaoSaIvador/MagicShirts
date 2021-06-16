@extends('template')
@section('title', 'Histórico de Encomendas')
@section('content')

<div class="container">
    <div class="py-5 ">
        <div class="row">
            <div class="col-md-12 ">
                <h4 class="mb-3">Histórico de Encomendas</h4>

                <hr class="mb-4">

                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th>Id da Encomenda</th>
                            <th>Estado</th>
                            <th>Data</th>
                            <th>Preço Total</th>
                            <th>Opcional</th>
                        </tr>
                    </thead>
                    <tbody class="bg-light">
                        @foreach ($encomendas as $encomenda)
                        <tr>
                            <td>{{$encomenda->id}}</td>
                            <td>{{$encomenda->estado}}</td>
                            <td>{{$encomenda->data}}</td>
                            <td>${{$encomenda->preco_total}}</td>
                            <td>
                                <a href="{{route('Order.client.view', ['encomenda' => $encomenda])}}"><button type="button" class="btn btn-primary launch">Detalhes</button></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>


@endsection