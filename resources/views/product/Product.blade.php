@extends('template')
@section('content')
<div class="container-fluid">
    <section class="row">
        <div class="col d-flex justify-content-center">
            <img class="product-img mx-auto" src="{{($estampa->cliente_id == null) ? asset('storage/estampas/' . $estampa->imagem_url) : asset('img/default_img.jpg') }}" alt="Imagem da Estampa">
        </div>
        <div class="col">
            <p class="display-6 font-weight-bold">{{$estampa->nome}}</p>
            <p class="text-justify">{{$estampa->descricao}}</p>
            <div class="product_meta">
                <span class="posted_in"> <strong>Categoria:</strong> <a rel="tag" href="{{route('Catalogue')}}">{{$categoria}}</a></span>
            </div>
            <div class="m-bot15"> <strong>Preco: </strong><span class="pro-price"> ${{$preco->preco_un_catalogo}}</span></div>
            <div class="form-group">
            <label>Quantity</label>
                <input type="quantiy" placeholder="1" class="form-control quantity">
            </div>
            <a href="{{route('Cart')}}"><button class="btn btn-round btn-danger" type="button"><i class="fa fa-shopping-cart"></i> Add to Cart</button></a>
        </div>
      </section>
</div>
@endsection
