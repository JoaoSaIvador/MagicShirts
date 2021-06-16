@extends('template')
@section('title', 'Editar Categoria')
@section('content')
    <div class="container">
        <form method="POST" action="{{route('Categories.update', ['categoria' => $categoria])}}" class="form-group" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('categories.partials.create-edit')
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Alterar</button>
                <a href="{{route('Categories')}}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
