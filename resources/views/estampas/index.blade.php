@extends('template')
@section('content')
<form action="#" method="GET">
    <div class="estampas-search">
        <label for="idCategoria">Tipo de categoria:</label>
        <select name="categoria_id" id="idCategoria">
            @foreach ($categorias as $id => $nome)
                <option value="{{$id}}"
                    {{$id == $categoria ? 'selected' : ''}}>{{$nome}}
                </option>
            @endforeach
        </select>
        <button type="submit" class="bt" id="btn-filter">Filtrar</button>
    </div>
</form>
<div class="estampas-area">
    @forelse ($estampas as $estampa)
    <div class="estampa">
        <div class="estampa-img">
            <img src="{{($estampa->cliente_id == null) ? asset('storage/estampas/' . $estampa->imagem_url) : asset('img/default_img.png') }}" alt="Imagem da Estampa" style="width:25%">
        </div>
        <div class="estampa-info">
            <div class="estampa-name">Nome: {{$estampa->nome}}</div>
            <div class="estampa-description">Descrição: {{$estampa->descricao}}</div>
        </div>
    @empty
        <p>Não existem estampas</p>
    </div>
    @endforelse

</div>
@endsection
