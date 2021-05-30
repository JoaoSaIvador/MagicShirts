@extends('template')
@section('title', 'MagicShirts - Registar')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="authCardBody">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group row">
                    <label for="name">{{ __('Nome') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="email">{{ __('E-Mail') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror        
                </div>

                <div class="form-group row">
                    <label for="password" >{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror      
                </div>

                <div class="form-group row">
                    <label for="password-confirm">{{ __('Confirmar Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">  
                </div>

                <div class="form-group row">
                    <div class="authButtonsContainer">
                        <a href="/login">
                            <button type="button" class="authButtons">{{ __('Já tem conta?') }}</button>   
                        </a>
                        <button type="submit" class="authButtons authRightButton">{{ __('Registar') }}</button>         
                    </div>
                </div> 
            </form>
        </div>
    </div>
</div>

@endsection
