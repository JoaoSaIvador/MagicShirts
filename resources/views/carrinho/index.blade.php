@extends('template')
@section('content')
<div>
<form class="text-white bg-dark" action="#" method="GET">
    <label for="idCategoria">Tipo de categoria:</label>
    <select name="categoria_id" id="idCategoria">
        @foreach ($categorias as $id => $nome)
            <option value="{{$id}}"
                {{$id == $categoria ? 'selected' : ''}}>{{$nome}}
            </option>
        @endforeach
    </select>
    <button type="submit" class="bt" id="btn-filter">Filtrar</button>
</form>
<button class="me-auto" type="submit">Mostrar Estampas Pessoais</button>
</div>
<div class="album py-5 bg-dark">
    <div class="container">
        <div class="row">
            @forelse ($estampas as $estampa)
                <div class="col-md-4">
                    <div class="card box-shadow">
                        <img class="card-img-top bg-dark estampa-img" src="{{($estampa->cliente_id == null) ? asset('storage/estampas/' . $estampa->imagem_url) : asset('img/default_img.jpg') }}" alt="Imagem da Estampa">
                    </div>
                    <div class="card-body bg-light">
                        <p class="fst-normal bg-light">{{$estampa->nome}}</p>
                    </div>
                </div>
            @empty
            <p class="text-white bg-dark">Não existem estampas</p>
        @endforelse
        </div>
    </div>
</div>
@endsection
