@extends('template')
@section('title', 'Catálogo')
@section('content')
<div class="mb-3 cat-top py-5 sel-stamps">
    <div class="">
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
    <div style="width: 250px; padding:0 12px;">
        @can ('viewPrivate',App\Models\Estampa::class)
            <a class="btn btn-dark text-light" href="{{route('Catalogue.personal')}}">Mostrar Estampas Pessoais</a>
        @endcan
    </div>
    <form method="GET" action="#" class="form-group">
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="Search" placeholder="Pesquisar Nome ou Descrição"><br>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
                </div>
            </div>
        </form>
</div>
<div class="album">
    <div class="container-xl">
        <div class="row" style="justify-content: center;">
            @forelse ($estampas as $estampa)
                @include('partials.Catalogue-card')
                    </div>
                </div>
            @empty
                <p class="display-4 font-weight-bold">Não existem estampas</p>
            @endforelse
            <div class="d-flex justify-content-center">
                {{ $estampas->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
