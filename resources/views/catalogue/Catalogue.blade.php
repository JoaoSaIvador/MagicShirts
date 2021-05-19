@extends('template')
@section('content')
<div class="row mb-3 cat-top py-5 sel-stamps">
    <div class="col-5 ">
        <form method="GET" action="#" class="form-group">
            <div class="input-group">
                <select class="custom-select" name="categoria_id" id="idCategoria">
                    @foreach ($categorias as $id => $nome)
                    <option value="{{$id}}"
                        {{$id == $categoria ? 'selected' : ''}}>{{$nome}}
                    </option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="" style="width: 250px;">
        <button class="btn btn-dark" type="submit">Mostrar Estampas Pessoais</button>
    </div>
</div>
<div class="album">
    <div class="container-xl">
        <div class="row" style="justify-content: center;">
            @forelse ($estampas as $estampa)
                <div class="card col-lg-3 m-2">
                    <div class="view overlay">
                    <img class="card-img-top estampa-img" id="card-img-top" src="{{($estampa->cliente_id == null) ? asset('storage/estampas/' . $estampa->imagem_url) : asset('img/default_img.jpg') }}" alt="Imagem da Estampa">
                        <a href="#!">
                        <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>

                    <div class="card-body text-center">

                        <h5>{{$estampa->nome}}</h5>
                        <p class="small text-muted text-uppercase mb-2">Shirts</p>
                        <hr>
                        <h6 class="mb-3">
                        <span class="text-danger mr-1">$12.99</span>
                        </h6>

                        <form method="GET" action="#" class="form-group">
                            <div class="catalogue-input">
                                <select class="custom-select catalogue-select" name="color_id">
                                    @foreach ($cores as $id => $nome)
                                    <option value="{{$id}}">{{$nome}}</option>
                                    @endforeach
                                </select>

                                <select class="custom-select catalogue-select" name="tamanho_abrev">
                                    @foreach ($tamanhos as $abrev)
                                    <option value="{{$abrev}}">{{$abrev}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button type="button" class="btn btn-primary btn-sm mr-1 mb-2 add-cart">
                            <i class="fa fa-shopping-cart pr-2"></i>Add to cart
                            </button>
                        </form>
                        
                    </div>
                </div>
            @empty
            <p class="text-white bg-dark">Não existem estampas</p>
            @endforelse
        </div>
    </div>
</div>


@endsection
