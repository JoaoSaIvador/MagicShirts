@extends('template')
@section('content')
<div class="container">
    <div class="col-5 ">
        <form method="GET" action="#" class="form-group">
            <div class="input-group">
                <select class="custom-select" id="idFiltro">
                    <option value="none" selected disabled hidden>Filtrar por</option>
                    <option value="" >Sem Filtro</option>
                    <option value="cliente_id">Cliente Id

                    </option>
                    <option value="estado">Estado
                        <select name="valor" id="PLACEHOLDER">
                            <option value="anulada">Anulada</option>
                            <option value="fechada">Fechada</option>
                            <option value="pendente">Pendente</option>
                            <option value="aberta">Aberta</option>
                        </select>
                    </option>
                    <option value="data">Data

                    </option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                </div>
            </div>
        </form>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Id da Encomenda</th>
                <th>Estado</th>
                <th>Data</th>
                <th>Preço Total</th>
                <th>Opcional</th>
                <th></th>
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
                    <a href="{{route('Orders.view', ['encomenda' => $encomenda])}}"><button type="button" class="btn btn-primary launch">Detalhes</button></a>
                </td>
                <td>
                    <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$encomenda->id}}" aria-expanded="false" aria-controls="collapseOrder">
                        Alterar
                    </button>
                    <div class="collapse mb-n3 mt-2" id="collapse{{$encomenda->id}}">
                        <form action="{{route('Orders.update', ['encomenda' => $encomenda])}}" method="POST" class="form-group">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <select name="estado" class="custom-select col">
                                    <option value="none" selected disabled hidden>Alterar Estado</option>
                                    <option value="paga">Paga</option>
                                    <option value="fechada">Fechada</option>
                                    <option value="anulada">Anulada</option>
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm col ml-1">Save</button>
                            </div>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    {{ $encomendas->withQueryString()->links() }}
    </div>
</div>
@endsection
