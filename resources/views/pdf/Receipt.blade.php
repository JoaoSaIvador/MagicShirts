<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recibo</title>
    <link href="{{asset('CSS/bootstrap3_3_6.min.css')}}" rel="stylesheet">
</head>

<body>
    <div class="container bg-light w-50">
        <div>
            <h2 class="display-5">Detalhes da Encomenda {{$id}}</h2>
        </div>
        <hr>
        <div>
            <h4 class="display-8">{{$user}}</h4>
            <p class="font-weight-bold mt-5">Informação da Encomenda</p>
            <dl class="row">
                <dt class="col-sm-3">NIF</dt>
                <dd class="col-sm-9">{{$nif}}</dd>

                <dt class="col-sm-3">Endereço</dt>
                <dd class="col-sm-9"><p>{{$endereco}}</p></dd>

                <dt class="col-sm-3">Tipo de pagamento</dt>
                <dd class="col-sm-9">{{$tipo_pagamento}}</dd>

                <dt class="col-sm-3">Ref de pagamento</dt>
                <dd class="col-sm-9">{{$ref_pagamento}}</dd>

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
            <p class="fs-2">Total: {{$preco_total}}</p>
        </div>
    </div>
</body>

</html>
