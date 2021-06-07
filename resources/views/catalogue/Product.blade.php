@extends('template')
@section('content')
<div class="container-fluid">
    <section class="row">
        <div class="col d-flex justify-content-center">
            <img class="product-img mx-auto" src="{{$estampa->getImagemFullUrl()}}" alt="Imagem da Estampa">
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
                <div class="m-bot15"> <input type="text" hidden value="{{$preco}}" name="preco_un"><strong>Preco: </strong><span class="pro-price"> ${{$preco}}</span></div>
                <hr>
                <select name="cor_codigo" class="custom-select catalogue-select">
                    <option value="none" selected disabled hidden>Cor da T-shirt</option>
                    @foreach ($cores as $id => $nome)
                        <option value="{{$id}}" {{old('cor_codigo') == $id ? 'selected' : '' }}>{{$nome}}</option>
                    @endforeach
                </select>
                @error('cor_codigo')
                    <div class="small text-danger">{{$message}}</div>
                @enderror
                <p class="text-left">Tamanho da T-shirt</p>
                @foreach ($tamanhos as $abrev)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="tamanho" value="{{$abrev}}" {{old('tamanho') == $abrev ? 'checked' : ''}}>
                        <label class="form-check-label">{{$abrev}}</label>
                    </div>
                @endforeach
                <div class="d-flex mb-4 " style="width: 100px">
                  <div class="form-outline">
                    <label class="form-label" for="form1">Quantidade:</label>
                    <input id="form1" min="0" name="quantidade" value="1" type="number" class="form-control" />
                  </div>
                </div>
                @error('quantidade')
                    <div class="small text-danger">{{$message}}</div>
                @enderror
                <button class="btn btn-round btn-danger" type="submit"><i class="fa fa-shopping-cart"></i> Add to Cart</button>
            </form>
        </div>
      </section>
</div>
@endsection
