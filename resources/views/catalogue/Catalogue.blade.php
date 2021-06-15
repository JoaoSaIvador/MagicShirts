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
    <div style="width: 250px">
        @can ('viewPersonal',App\Models\Estampa::class)
            <a class="btn btn-dark text-light" href="{{route('Catalogue.personal')}}">Mostrar Estampas Pessoais</a>
        @endcan
    </div>
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
