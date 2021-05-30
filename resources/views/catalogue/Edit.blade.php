@extends('template')
@section('content')
    <div class="container">
        <form method="POST" action="{{route('Catalogue.update', ['estampa' => $estampa])}}" class="form-group" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('catalogue.partials.create-edit')
            <div class="form-group">
                <img src="{{$estampa->imagem_url ? asset('storage/estampas/' . $estampa->imagem_url) : asset('img/default_img.jpg') }}"
                     alt="Foto da estampa"  class="img-profile"
                     style="max-width:100%">
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Alterar</button>
                <a href="{{route('Catalogue.edit', ['estampa' => $estampa])}}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
