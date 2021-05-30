@extends('template')
@section('content')
<div class="mb-3 cat-top py-5 sel-stamps">
    <div class="col-5 ">
        <form method="GET" action="#" class="form-group">
            <div class="input-group">
                <select class="custom-select" name="categoria_id" id="idCategoria">
                    <option value="none" selected disabled hidden>Tipo de Categoria</option>
                    <option value="" >Sem Categoria</option>
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
    @auth
        <button class="btn btn-dark" type="submit">Mostrar Estampas Pessoais</button>
    @endauth

    </div>
</div>
<div class="album">
    <div class="container-xl">
        <div class="row" style="justify-content: center;">
            @forelse ($estampas as $estampa)
                <div class="card col-lg-3 m-2">
                    <div class="view overlay">
                        <a href="{{route('Catalogue.view', ['estampa' => $estampa])}}">
                            <img class="card-img-top estampa-img" id="card-img-top" src="{{($estampa->cliente_id == null) ? asset('storage/estampas/' . $estampa->imagem_url) : asset('img/default_img.jpg') }}" alt="Imagem da Estampa">
                        </a>
                        <div class="mask rgba-white-slight"></div>
                    </div>
                    <hr>
                    <div class="card-body text-center">
                        <h5>{{$estampa->nome}}</h5>
                    </div>
                </div>
            @empty
            <p class="display-4 font-weight-bold">Não existem estampas</p>
            @endforelse
        </div>
        <div class="d-flex justify-content-center">
            {{ $estampas->withQueryString()->links() }}
            @auth
                <a class="btn btn-success btn-s ml-2 mb-3" href="{{route('Catalogue.create')}}" role="button" aria-pressed="true">Adicionar Estampa</a>
            @endauth
        </div>
    </div>
</div>


@endsection
