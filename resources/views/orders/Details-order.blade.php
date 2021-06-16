@extends('template')
@section('title', 'Detalhes da Encomenda')
@section('content')
<div class="container bg-light w-50">
    <div>
        <h2 class="display-5">Detalhes da Encomenda {{$encomenda->id}}</h2>
    </div>
    <hr>
    <div>
        <h4 class="display-8">{{$user}}</h4>
        <p class="font-weight-bold mt-5">Informação da Encomenda</p>
        <dl class="row">
            <dt class="col-sm-3">NIF</dt>
            <dd class="col-sm-9">{{$encomenda->nif}}</dd>

            <dt class="col-sm-3">Endereço</dt>
            <dd class="col-sm-9">
              <p>{{$encomenda->endereco}}</p>
            </dd>

            <dt class="col-sm-3">Tipo de pagamento</dt>
            <dd class="col-sm-9">{{$encomenda->tipo_pagamento}}</dd>

            <dt class="col-sm-3">Ref de pagamento</dt>
            <dd class="col-sm-9">{{$encomenda->ref_pagamento}}</dd>

            <dt class="col-sm-3">Recibo url</dt>
            <dd class="col-sm-9">{{$encomenda->recibo_url}}</dd>
          </dl>
    </div>
    <hr>
    <div class="container">
        <p class="fs-2">Items</p>
        @foreach ($tshirts as $tshirt)
            <p class="fs-6">{{$estampas[$loop->index]}} {{$cores[$loop->index]}}</p>
            <dl class="row">
                <dt class="col-sm-3">Tamanho</dt>
                <dd class="col-sm-9">{{$tshirt->tamanho}}</dd>

                <dt class="col-sm-3">Quantidade</dt>
                <dd class="col-sm-9"><p>{{$tshirt->quantidade}}</p></dd>

                <dt class="col-sm-3">Preço por unidade</dt>
                <dd class="col-sm-9">${{$tshirt->preco_un}}</dd>

                <dt class="col-sm-3">Sub Total</dt>
                <dd class="col-sm-9">${{$tshirt->subtotal}}</dd>
            </dl>
        @endforeach
        <hr>
        <p class="fs-2">Total: {{$encomenda->preco_total}}</p>
        <button class="btn btn-primary mb-4" onclick="window.location='{{ url("/encomendas") }}'">Voltar</button>
    </div>
</div>
@endsection
