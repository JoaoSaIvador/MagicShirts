@extends('template')
@section('content')

<div class="container">
    <div class="py-5 ">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Carrinho de Compras ({{$carrinho['quantidadeItens']}})</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach ($carrinho['items'] as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                        {{$item['nome']}} T-shirt ({{$item['quantidade']}}):
                        <span>${{$item['subtotal']}}</span>
                    </li>
                    @endforeach
                    <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                        <div>
                            <strong>Preço Final:</strong>
                        </div>
                        <span><strong>${{$carrinho['precoTotal']}}</strong></span>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Informação de Envio</h4>
                <form class="needs-validation" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Nome</label>
                        <input type="text" class="form-control" name="nome" value="{{ old('nome') ?? $user->name }}">
                        @error('nome')
                        <div class="small text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>NIF <span class="text-muted"></span></label>
                        <input type="text" class="form-control" name="nif" value="{{ old('nif') ?? ($user->cliente->nif ?? '') }}">
                        @error('nif')
                        <div class="small text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Morada de Envio</label>
                        <input type="text" class="form-control" name="morada" value="{{ old('morada') ?? ($user->cliente->endereco ?? '') }}">
                        @error('morada')
                        <div class="small text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label>Notas</label>
                        <input type="text" class="form-control" name="notas" value="{{ old('notas') }}">
                        @error('notas')
                        <div class="small text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <hr class="mb-4">
                    <h4 class="mb-3">Método de Pagamento</h4>

                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input name="metodo_pagamento" value="VISA" type="radio" class="custom-control-input" {{ old('metodoPagamento') ? 'checked' : ($user->cliente->tipo_pagamento ? 'checked' : '') }}>
                            <label class="custom-control-label">Cartão Visa</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input name="metodo_pagamento" value="MC" type="radio" class="custom-control-input" {{ old('metodoPagamento') ? 'checked' : ($user->cliente->tipo_pagamento ? 'checked' : '') }}>
                            <label class="custom-control-label">Mastercard</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input name="metodo_pagamento" value="PAYPAL" type="radio" class="custom-control-input" {{ old('metodoPagamento') ? 'checked' : ($user->cliente->tipo_pagamento ? 'checked' : '') }}>
                            <label class="custom-control-label">Paypal</label>
                        </div>
                        @error('metodo_pagamento')
                        <div class="small text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Referência de Pagamento</label>
                            <input type="text" class="form-control" name="ref_pagamento" value="{{$user->cliente->ref_pagamento ?? ''}}">
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button action="{{route('Checkout.finalize')}}" class="btn btn-primary btn-lg btn-block" type="submit">Finalizar Compra</button>


                </form>
            </div>
        </div>
    </div>
</div>

@endsection