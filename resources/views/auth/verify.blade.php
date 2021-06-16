@extends('template')
@section('title', 'MagicShirts - Entrar')
@section('content')
<div class="container">
    <div class="justify-content-center">
        <div class="authCardBody">
                <div class="card-header">{{ __('Verifique o seu Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Uma verificação nova foi enviada para o seu email.') }}
                        </div>
                    @endif

                    {{ __('Antes de proceder verifique o seu email.') }}
                    {{ __('Não recebeu email?') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Novo pedido') }}</button>.
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection
