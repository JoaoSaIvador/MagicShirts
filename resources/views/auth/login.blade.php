@extends('template')
@section('title', 'MagicShirts - Entrar')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="authCardBody">
            <form method="POST" action="{{ route('login') }}">@csrf

                <div class="authLogo">
                    <img src="{{asset('img/MagicShirtsLogo.png')}}" alt="MagicShirts LOGO">
                </div>

                <div class="form-group row">
                    <label for="email">{{ __('Endereço E-Mail') }}</label>
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
                    <label for="password">{{ __('Password') }}</label>
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
                    <div class="col-md-6 ">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">
                                {{ __('Lembrar') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="authButtonsContainer">
                        <a href="/register">
                            <button type="button" class="authButtons">{{ __('Registar') }}</button>   
                        </a>

                        <button type="submit" id="loginButton" class="authButtons">{{ __('Entrar') }}</button>         
                    </div>
                </div> 

                <div class="form-group row">
                    <div id="authLinkContainer">
                        @if (Route::has('password.request'))  
                            <a class="authLink" href="{{ route('password.request') }}">{{ __('Esqueceu-se da password?') }}</a>
                        @endif
                    </div>
                </div> 

            </form>
        </div>
    </div>
</div>
@endsection




