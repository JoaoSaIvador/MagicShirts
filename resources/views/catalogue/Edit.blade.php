@extends('template')
@section('title', 'Editar Estampa')
@section('content')
    <div class="container">
        <form method="POST" action="{{route('Stamps.update', ['estampa' => $estampa])}}" class="form-group" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('catalogue.partials.create-edit')
            <div class="form-group">
                <img src="{{$estampa->getImagemFullUrl() }}"
                     alt="Foto da estampa"  class="img-profile"
                     style="max-width:25%">
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Alterar</button>
                <a href="{{url()->previous()}}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
