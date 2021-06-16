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
            <h2 class="display-5">Detalhes da Encomenda</h2>
        </div>
        <hr>
        <div>
            <h3 style="font-size: 200%">{{$user}}</h4>
            <hr>
            <p class="font-weight-bold mt-5" style="font-weight: bold; font-size: 125%">Informação da Encomenda</p>
            <dl class="row">
                <p class="col-sm-3" style="font-weight: bold">NIF:
                <span style="font-weight: normal">{{$nif}}</span></p>

                <p class="col-sm-3" style="font-weight: bold">Endereço:
                <span style="font-weight: normal">{{$endereco}}</span></p>

                <p class="col-sm-3" style="font-weight: bold">Tipo de pagamento:
                <span style="font-weight: normal">{{$tipo_pagamento}}</span></p>

                <p class="col-sm-3" style="font-weight: bold">Ref de pagamento:
                <span style="font-weight: normal">{{$ref_pagamento}}</dd></p>

            </dl>
        </div>
        <hr>
        <div class="container">
            <p style="font-size: 175%">Items</p>
            @foreach ($tshirts as $tshirt)
                <p style="font-size: 20px">{{$estampas[$loop->index]}} {{$cores[$loop->index]}}</p>
                <dl class="row">
                    <p class="col-sm-3" style="font-weight: bold">Tamanho:
                    <span class="col-sm-9" style="font-weight: normal">{{$tshirt->tamanho}}</span></p>

                    <p class="col-sm-3" style="font-weight: bold">Quantidade:
                    <span class="col-sm-9" style="font-weight: normal">{{$tshirt->quantidade}}</span></p>

                    <p class="col-sm-3" style="font-weight: bold">Preço por unidade:
                    <span class="col-sm-9" style="font-weight: normal">${{$tshirt->preco_un}}</span></p>

                    <p class="col-sm-3" style="font-weight: bold">Sub Total:
                    <span class="col-sm-9" style="font-weight: normal">${{$tshirt->subtotal}}</span></p>
                </dl>
            @endforeach
            <hr>
            <p style="font-weight: bold">Total: {{$preco_total}}</p>
        </div>
    </div>
</body>

</html>
