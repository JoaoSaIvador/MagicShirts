@extends('admin.OrdersManagement')
@section('orders')
<div class="mb-2">
    <a href="{{route('Orders.changefilter', ['Filter' => 'estado'])}}"><button type="button" class="btn btn-primary launch">Estado</button></a>
    <a href="{{route('Orders.changefilter', ['Filter' => 'data'])}}"><button type="button" class="btn btn-primary launch">Data</button></a>
</div>

<form action="{{route('Orders.filter', ['Filter' => $filtro])}}" method="GET" class="form-group">
@csrf
    <div class="input-group mb-3">
        <input type="text" class="form-control" name="valor" placeholder="Nº de Cliente"><br>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
        </div>
    </div>
</form>
@endsection
