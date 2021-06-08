@extends('template')
@section('content')
<style>
.mainmenu{
    position: fixed;
    width:100%;
    margin-bottom: 80px;
}
</style>
<div >

</div >
<div class="adminMainMenu">
    <div class="adminMenu">
        <a href="{{route('Dashboard')}}">Dashboard</a>
        <a href="{{route('Orders')}}">Encomendas</a>
        <a href="{{route('Users')}}">Utilizadores</a>
        <a href="{{route('Categories')}}">Categorias</a>
        <a href="{{route('Stamps')}}">Estampas</a>
        <a href="{{route('Colors')}}">Cores</a>
    </div>
    <div class="adminContent">
        @yield("adminContent")
    </div>
</div>
@endsection
