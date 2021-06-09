@extends('template')
@section('content')
    <div class="container">
        <form method="POST" action="{{route('Prices.update', ['preco' => $preco])}}" class="form-group" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @isset()

            @endisset
            @isset()

            @endisset

            <div class="form-group">
                <label for="inputNome" class="fs-2">Nome da Cor</label>
                <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $cor->nome)}}">
                @error('nome')
                   <div class="small text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputNome" class="fs-2">Nome da Cor</label>
                <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $cor->nome)}}">
                @error('nome')
                   <div class="small text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputNome" class="fs-2">Nome da Cor</label>
                <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $cor->nome)}}">
                @error('nome')
                   <div class="small text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputNome" class="fs-2">Nome da Cor</label>
                <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $cor->nome)}}">
                @error('nome')
                   <div class="small text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="inputNome" class="fs-2">Nome da Cor</label>
                <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $cor->nome)}}">
                @error('nome')
                   <div class="small text-danger">{{$message}}</div>
                @enderror
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-success" name="ok">Alterar</button>
                <a href="{{route('Colors')}}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
