@extends('template')
@section('title', 'MagicShirts - Entrar')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="authCardBody">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email">{{ __('E-Mail ') }}</label>

                            <div >
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="authButtonsContainer">
                                <button type="submit" class="authButtons">
                                    {{ __('Enviar link de recuperação') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

@endsection
