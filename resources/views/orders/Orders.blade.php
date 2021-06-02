@extends('template')
@section('content')
<div class="container">
    @yield('orders')
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
