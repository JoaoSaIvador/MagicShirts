@extends('template')
@section('title', 'Detalhes da Encomenda')
@section('content')
<div class="container bg-light w-50">
    <div>
        <h2 class="display-5">Detalhes da Encomenda {{$encomenda->id}}</h2>
    </div>
    <hr>
    <div>
        <h4 class="display-8">{{$user->name}}</h4>
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
        <p class="fs-6">{{$estampas[$loop->index]['nome']}} {{$cores[$loop->index]}}</p>
        <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
            {{-- Image --}}
            <div class="bg-image hover-overlay hover-zoom ripple rounded preview" data-mdb-ripple-color="light">
                <svg id="product-preview-svg" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 612 586">
                    <path style="fill: #{{$tshirt->cor_codigo}}" d="M14.74 163.94l35.49-21.29 26.45-21.29 29.68-25.81 27.09-21.94 20.65-17.42 27.74-14.84 27.1-6.45 34.19-13.54 8.39-2.59 5.8 5.16 8.39 5.17 10.32 5.16L287 36.19l14.19 1.94h11.62l12.25-.65 9.04-1.93 9.03-3.87 5.81-3.23 5.16-5.16 3.22-1.29h5.81l8.39 2.58 14.19 5.81 14.84 4.51 14.19 3.87L427 42.65l9.03 2.58 10.33 5.8 12.9 8.39 10.97 9.03 10.32 9.03 13.55 13.88 14.19 10 11.61 9.03 10.33 7.09 12.25 8.39 12.91 7.74 12.25 8.39 10.33 5.81 7.74 5.8 10.32 6.45v3.88l-10.96 10.32-12.26 12.26-9.68 12.25-11.61 12.91-11.62 13.55-8.38 11.61-7.1 12.26-14.19-5.81-10.33-5.81-9.03-7.09-9.03-5.81h-7.74l-7.1 3.23v8.38l.64 17.42 1.3 6.45V316.19l.64 15.49 1.29 17.42v21.29l1.29 30.97.65 17.41.64 21.29 1.29 18.71.65 13.55.64 13.55 1.29 15.49.65 10.32v12.9l1.93 11.61.65 8.39.64 9.03h-9.67l-14.84-3.22-27.74-.65h-19.36l-20.64 3.87H256.03l-35.48-3.22-20-.65h-19.36l-31.61.65.65-37.42-1.94-49.68-.64-39.35v-100l-3.23-44.52-3.23-40 3.23-20-5.16 1.29-9.03 7.1-10.97 6.45-11.62 10.97-12.9 11.61-9.03-14.19-8.39-7.75-11.61-15.48-14.19-11.61-11.62-11.62L27 180.71l-12.26-16.77z" />
                </svg>

                <img src="{{asset('storage/tshirt_base/default.jpg')}}" id="product-preview" />
                <img src="{{$estampas[$loop->index]['imagem_url']}}" class="preview-stamp" />
            </div>
            {{-- Image --}}
        </div>
        <dl class="row">

            <dt class="col-sm-3">Tamanho</dt>
            <dd class="col-sm-9">{{$tshirt->tamanho}}</dd>

            <dt class="col-sm-3">Quantidade</dt>
            <dd class="col-sm-9">
                <p>{{$tshirt->quantidade}}</p>
            </dd>

            <dt class="col-sm-3">Preço por unidade</dt>
            <dd class="col-sm-9">${{$tshirt->preco_un}}</dd>

            <dt class="col-sm-3">Sub Total</dt>
            <dd class="col-sm-9">${{$tshirt->subtotal}}</dd>
        </dl>

        @endforeach
        <hr>
        <p class="fs-2">Total: {{$encomenda->preco_total}}</p>
        <button class="btn btn-primary mb-4" onclick="goBack()">Voltar</button>
    </div>
</div>
<script>
    function goBack() {
      window.history.back();
    }
    </script>
@endsection
