@extends('template')
@section('title', 'MagicShirts - Entrar')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="authCard">
            <div class="authCardBody">
                <form method="POST" action="{{ route('login') }}">
                        @csrf

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label">{{ __('Endereço E-Mail') }}</label>
                        <div>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                        <div>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Lembrar') }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Entrar') }}
                            </button>       
                        </div>
                        <div>
                            <ul class="navbar-nav ms-auto">
                                @if (Route::has('register'))
                                    <li class="dropdown-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Registar') }}</a>
                                    </li>
                                @endif
                                @if (Route::has('password.request'))
                                    <li class="dropdown-item">
                                        <a class="btn btn-link" href="{{ route('password.request') }}">{{ __('Esqueceu-se da password?') }}</a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
