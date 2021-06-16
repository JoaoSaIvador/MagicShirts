@extends('template')
@section('title', 'Criar Categoria')
@section('content')
    <div class="container">
        <form method="POST" action="{{route('Categories.store')}}" class="form-group" enctype="multipart/form-data">
            @csrf
            @include('categories.partials.create-edit')
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Criar</button>
                <a href="{{route('Categories')}}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
