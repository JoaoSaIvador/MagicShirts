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
    <div id="wrapper">
        <ul class="navbar-nav adminSideBar sidebar sidebar-dark accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
                <div class="sidebar-brand-icon">
                    <img src="{{asset('img/MagicShirtsLogo.png')}}" alt="MagicShirts LOGO" class="logo-img">
                </div>
            </a>
            <hr class="sidebar-divider my-0">
            <li class="nav-item ml-2">
                <a class="nav-link" href="{{route('Dashboard')}}">
                    <span>Dashboard</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <li class="nav-item ml-2">
                <a class="nav-link" href="{{route('Orders')}}">
                    <span>Encomendas</span></a>
            </li>
            <li class="nav-item ml-2">
                <a class="nav-link" href="{{route('Users')}}">
                    <span>Utilizadores</span></a>
                </li>
            <li class="nav-item ml-2">
                <a class="nav-link" href="{{route('Categories')}}">
                    <span>Categorias</span>
                </a>
            </li>
            <li class="nav-item ml-2 ">
                <a class="nav-link" href="{{route('Stamps')}}">
                    <span>Estampas</span>
                </a>
            </li>
            <li class="nav-item ml-2 ">
                <a class="nav-link" href="{{route('Colors')}}">
                    <span>Cores</span>
                </a>
            </li>
            <li class="nav-item ml-2 ">
                <a class="nav-link" href="{{route('Prices')}}">
                    <span>Preços</span>
                </a>
            </li>
        </ul>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content" style="background-color: #212121">
                <nav class="mainmenu navbar navbar-expand-lg mb-4 static-top shadow">
                    <div class="container-fluid">
                        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="dropdown-item text-light" href="{{route('Catalogue')}}">Catálogo</a>
                            </li>
                            @auth
                                @if (auth()->user()->tipo != 'C')
                                <li class="nav-item">
                                    <a class="dropdown-item text-light" href="{{route('Dashboard')}}">Administrador</a>
                                </li>
                                @endif
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
                                        <a class="dropdown-item text-light" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                        {{-- @if (session('alert-msg'))
                            @include('partials.message')
                        @endif
                        @if ($errors->any())
                            @include('partials.errors-message')
                        @endif --}}
                    </div>
                </nav>
                <div class="row">
                    <div class="col">
                        @yield('adminContent')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.js" integrity="sha512-CAv0l04Voko2LIdaPmkvGjH3jLsH+pmTXKFoyh5TIimAME93KjejeP9j7wSeSRXqXForv73KUZGJMn8/P98Ifg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('js/Chart.min.js')}}"></script>
    @yield('script')
</body>
