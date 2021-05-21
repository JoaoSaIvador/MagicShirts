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
                <span class="posted_in"> <strong>Categoria:</strong>
                    <input type="submit" hidden><a rel="tag" href="{{route('Catalogue', ['categoria_id' => $estampa->categoria_id])}}">{{$categoria}}</a>
                </span>
            </div>
            <form action="{{route('Cart.store')}}" method="post">
            @csrf
                <input type="number" name="estampa_id" hidden value="{{$estampa->id}}">
                <div class="m-bot15"> <input type="text" hidden value="{{$preco->preco_un_catalogo}}" name="preco_un"><strong>Preco: </strong><span class="pro-price"> ${{$preco->preco_un_catalogo}}</span></div>
                <hr>
                <select name="color_id" class="custom-select catalogue-select">
                    <option value="none" selected disabled hidden>Cor da T-shirt</option>
                    @foreach ($cores as $id => $nome)
                        <option value="{{$id}}">{{$nome}}</option>
                    @endforeach
                </select>
                <p class="text-left">Tamanho da T-shirt</p>
                @foreach ($tamanhos as $abrev)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tamanho" value="{{$abrev}}">
                        <label class="form-check-label">{{$abrev}}</label>
                    </div>
                @endforeach
                <div class="form-group">
                <label>Quantity</label>
                    <input type="quantiy" placeholder="1" name="quantidade" class="form-control quantity">
                </div>
                <button class="btn btn-round btn-danger" type="submit"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
            </form>
        </div>
      </section>
</div>
@endsection
