@extends('template')
@section('content')
<div class="adminMenu">
   
<a href="{{route('Dashboard')}}">Dashboard</a>
<a href="{{route('Orders')}}">Encomendas</a>
<a href="#">Utilizadores</a>
<a href="#">Estampas</a>
<a href="#">Cores</a>
</div>
<div class="adminContent">
@yield("adminContent")
</div>
@endsection
