<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/stylesheet.css')}}">
    <title>{{$pageTitle}}</title>
</head>
<body>
<nav class="mainmenu navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
    <img src="{{asset('img/MagicShirtsLogo.png')}}" alt="MagicShirts LOGO">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('estampas.index')}}">Estampas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('t-shirts.index')}}">T-Shirts</a>
        </li>
      </ul>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link" href="#">Carrinho</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Entrar/Registar</a>
            </li>
        </ul>
    </div>
  </div>
</nav>
    @yield('content')
</body>
</html>
