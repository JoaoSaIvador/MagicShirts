@extends('layout')
@section('title','Catálogo' )
@section('content')
<div>
@foreach ($listaEstampas as $estampa)
    <img src="{{$estampa->imagem_url ? asset('storage/estampas/' . $estampa->imagem_url) : asset('img/default_img.png')}}" alt="Imagem da Estampa">
    <p>Nome:{{$estampa->nome}} </p>
    <p>Categoria:{{$estampa->categoria_id}}</p>
    <p>Descrição{{$estampa->descricao}}</p>
@endforeach
</div>
@endsection
