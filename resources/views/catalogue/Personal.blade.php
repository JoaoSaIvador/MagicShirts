@extends('template')
@section('content')
<div class="d-flex justify-content-center mb-4">
    <a class="btn btn-success btn-s mr-1" href="{{route('Catalogue.create')}}" role="button" aria-pressed="true">Adicionar Estampa</a>
    <a class="btn btn-primary btn-s ml-1" href="{{ route('Catalogue') }}">Voltar</a>
</div>
@include('partials.Catalogue-card')

@endsection
