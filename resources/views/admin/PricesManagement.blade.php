@extends('home.dashboard')
@section('adminContent')
    <div class="row ml-auto mr-auto">
        <div class="col-sm-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title fs-2">Preço unidade Catálogo</h5>
                <p class="font-weight-bold fs-3">${{$precos[0]->preco_un_catalogo}}</p>
                <form action="{{route('Prices.update', ['preco' => $precos[0]->id])}}" method="post">
                @csrf
                    <input type="number" class="form-control" name="preco_un_catalogo" min="1" step="any" value="{{$precos[0]->preco_un_catalogo}}">
                    <button type="submit" class="btn btn-primary mt-1">Alterar</button>
                </form>
            </div>
        </div>
        </div>
        <div class="col-sm-3">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title fs-2">Preco unidade própria</h5>
                <p class="font-weight-bold fs-3">${{$precos[0]->preco_un_proprio}}</p>
                <form action="{{route('Prices.update', ['preco' => $precos[0]->id])}}" method="post">
                @csrf
                    <input type="number" class="form-control" name="preco_un_proprio" min="1" step="any" value="{{$precos[0]->preco_un_proprio}}">
                    <button type="submit" class="btn btn-primary mt-1">Alterar</button>
                </form>
            </div>
        </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title fs-2">Preço unidade Catálogo desconto</h5>
                    <p class="font-weight-bold fs-3">${{$precos[0]->preco_un_catalogo_desconto}}</p>
                    <form action="{{route('Prices.update', ['preco' => $precos[0]->id])}}" method="post">
                    @csrf
                        <input type="number" class="form-control" name="preco_un_catalogo_desconto" min="1" step="any" value="{{$precos[0]->preco_un_catalogo_desconto}}">
                        <button type="submit" class="btn btn-primary mt-1">Alterar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title fs-2">Preço unidade própria desconto</h5>
                    <p class="font-weight-bold fs-3">${{$precos[0]->preco_un_proprio_desconto}}</p>
                    <form action="{{route('Prices.update', ['preco' => $precos[0]->id])}}" method="post">
                    @csrf
                        <input type="number" class="form-control" name="preco_un_proprio_desconto" min="1" step="any" value="{{$precos[0]->preco_un_proprio_desconto}}">
                        <button type="submit" class="btn btn-primary mt-1">Alterar</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-sm-3">
            <div class="card text-center">
                <div class="card-body">
                    <h5 class="card-title fs-2">Quantidade Desconto</h5>
                    <p class="font-weight-bold fs-3">${{$precos[0]->quantidade_desconto}}</p>
                    <form action="{{route('Prices.update', ['preco' => $precos[0]->id])}}" method="post">
                    @csrf
                        <input type="number" class="form-control" name="quantidade_desconto" min="1" step="any" value="{{$precos[0]->quantidade_desconto}}">
                        <button type="submit" class="btn btn-primary mt-1">Alterar</button>
                    </form>
                </div>
            </div>
        </div>
  </div>
@endsection
