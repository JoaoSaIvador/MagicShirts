@extends('template')
@section('content')
    <div class="container">
        <form method="POST" action="{{route('Catalogue.store')}}" class="form-group" enctype="multipart/form-data">
            @csrf
            @include('catalogue.partials.create-edit')
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Criar</button>
                <a href="{{route('Catalogue.create')}}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
