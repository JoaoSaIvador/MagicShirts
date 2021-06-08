@extends('template')
@section('content')
<div class="container">
    <div class="d-flex justify-content-start mb-4">
        <a class="btn btn-success btn-s mr-1" href="{{route('Stamps.create')}}" role="button" aria-pressed="true">Adicionar Estampa</a>
        <a class="btn btn-primary btn-s ml-1" href="{{ route('Catalogue') }}">Voltar</a>
    </div>
</div>
@include('partials.Catalogue-card')

@endsection
