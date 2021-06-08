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
<div class="adminMenu">

<a href="{{route('Dashboard')}}">Dashboard</a>
<a href="{{route('Orders')}}">Encomendas</a>
<a href="{{route('Users')}}">Utilizadores</a>


<a href="#">Cores</a>
</div>
<div class="adminContent">
@yield("adminContent")
</div>
@endsection
