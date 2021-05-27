@extends('template')
@section('content')
<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Id da Encomenda</th>
                <th>Estado</th>
                <th>Data</th>
                <th>Preço Total</th>
                <th>Opcional</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($encomendas as $encomenda)
            <tr>
                <td>{{$encomenda->id}}</td>
                <td>{{$encomenda->estado}}</td>
                <td>{{$encomenda->data}}</td>
                <td>${{$encomenda->preco_total}}</td>
                <td>
                    <button type="button" class="btn btn-primary launch" data-toggle="modal" data-target="#staticBackdrop">Detalhes</button>
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-body ">
                                    <div class="text-right"> <i class="fa fa-close close" data-dismiss="modal"></i> </div>
                                    <div class="px-4 py-5">
                                        <h5 class="text-uppercase">Jonathan Adler</h5>
                                        <h4 class="mt-5 theme-color mb-5">Obrigado pelo seu pedido</h4> <span class="theme-color">Sumário do Pagamento</span>
                                        <div class="mb-3">
                                            <hr class="new1">
                                        </div>
                                        @foreach ($tshirts[$encomenda->id] as $tshirt)
                                            <div class="d-flex justify-content-between"> <span class="font-weight-bold">Ether Chair(Qty:1)</span> <span class="text-muted">$1750.00</span> </div>
                                            <div class="d-flex justify-content-between"> <small>Shipping</small> <small>$175.00</small> </div>
                                            <div class="d-flex justify-content-between"> <small>Tax</small> <small>$200.00</small> </div>
                                        @endforeach
                                        <div class="d-flex justify-content-between mt-3"> <span class="font-weight-bold">Total</span> <span class="font-weight-bold theme-color">${{$encomenda->preco_total}}</span> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <a href="{{route('Orders', ['encomenda' => $encomenda])}}"
                    class="btn btn-success" role="button" aria-pressed="true">Alterar</a>
                </td>
                <td>
                    <form action="{{route('Orders', ['encomenda' => $encomenda])}}" method="POST">
                        @csrf
                        @method("DELETE")
                            <input type="submit" class="btn btn-danger" value="Apagar">
                    </form>
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
