<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link href="{{asset('CSS/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{asset('CSS/Stylesheet.css')}}" rel="stylesheet">

    <title>@yield('title')</title>

</head>
<body>
    <nav class="mainmenu navbar navbar-expand-lg mb-4 static-top shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">
            <img src="{{asset('img/MagicShirtsLogo.png')}}" alt="MagicShirts LOGO">
        </a>
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
        <ul class="navbar-nav me-auto">
            <li class="nav-item">
                <a class="dropdown-item text-light" href="{{route('Catalogue')}}">Catálogo</a>
            </li>
            @auth
            <li class="nav-item">
                <a class="dropdown-item text-light" href="{{route('Dashboard')}}">Administrador</a>
            </li>
            @endauth

        </ul>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="dropdown-item text-light" href="{{route('Cart')}}">Carrinho</a>
                </li>
                @guest
                    @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="dropdown-item text-light" href="{{route('login')}}">Entrar/Registar</a>
                    </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="dropdown-item text-light" href="{{route('login')}}">Perfil</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                    </li>
                @endguest

            </ul>
        </div>
    </div>
    </nav>
    @yield('content')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>
