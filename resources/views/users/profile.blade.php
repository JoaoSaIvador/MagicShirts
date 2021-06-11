@extends('template')
@section('content')

<div class="container">
    <div class="py-5 ">
        <div class="row">
            <div class="col-md-12 order-md-1">
                <h4 class="mb-3">Informação de Utilizador</h4>
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Nome</label>
                            <input type="text" class="form-control" name="nome" value="{{ old('nome') ?? $user->name }}">
                            @error('nome')
                            <div class="small text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email" value="{{ old('email') ?? $user->email }}">
                            @error('email')
                            <div class="small text-danger">{{$message}}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>NIF</label>
                            <input type="text" class="form-control" name="nif" value="{{ old('nif') ?? $user->cliente->nif }}">
                            @error('nif')
                            <div class="small text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Morada</label>
                            <input type="text" class="form-control" name="morada" value="{{ old('nome') ?? $user->cliente->endereco }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>Tipo de Pagamento Predefinido</label>
                            <select class="custom-select " name="metodo_pagamento">
                                @foreach ($metodos as $metodo)
                                <option value="{{$metodo}}" {{$metodo == $user->cliente->tipo_pagamento ? 'selected' : ''}}>{{$metodo}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>Referência de Pagamento Predefinida</label>
                            <input type="text" class="form-control" name="ref_pagamento" value="{{ old('nome') ?? $user->cliente->ref_pagamento }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group">
                            <label for="inputFoto">Upload da foto</label>
                            <input type="file" class="form-control" name="foto" id="inputFoto">
                            @error('foto')
                            <div class="small text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        @isset($user->foto_url)
                        <div class="form-group">
                            <img src="{{$user->foto_url ? asset('storage/fotos/' . $user->foto_url) : asset('img/default_img.png') }}" alt="Foto do utilizador" class="img-profile" style="max-width:100%">
                        </div>
                        @endisset
                    </div>

                    <button type="submit" action="{{route('Profile.edit')}}" class="btn btn-primary cart-update">Atualizar</button>
                    <a href="{{route('Profile.reset')}}" class="btn btn-primary cart-update">Reset Password</a>
                    @isset($user->foto_url)
                    <button type="submit" class="btn btn-danger cart-update" name="deletefoto" form="form_delete_photo">Apagar Foto</button>
                    @endisset
                </form>
                <form id="form_delete_photo" action="{{route('Profile.foto.destroy')}}" method="POST">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
        <hr class="mb-4">
    </div>
</div>

@endsection