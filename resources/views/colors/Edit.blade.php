@extends('template')
@section('content')
    <div class="container">
        <form method="POST" action="{{route('Colors.update', ['cor' => $cor])}}" class="form-group" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('colors.partials.create-edit')
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Alterar</button>
                <a href="{{route('Colors')}}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
