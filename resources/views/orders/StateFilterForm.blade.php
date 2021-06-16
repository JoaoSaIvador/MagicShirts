@extends('admin.OrdersManagement')
@section('orders')

<div>
    <a href="{{route('Orders.changefilter', ['Filter' => 'cliente'])}}"><button type="button" class="btn btn-primary launch">Nº Cliente</button></a>
    <a href="{{route('Orders.changefilter', ['Filter' => 'data'])}}"><button type="button" class="btn btn-primary launch">Data</button></a>
</div>


<form action="{{route('Orders.filter', ['Filter' => $filtro])}}" method="GET" class="form-group">
@csrf
    <div class="input-group">
            <select name="valor" id="PLACEHOLDER">
                <option value="anulada">Anulada</option>
                <option value="fechada">Fechada</option>
                <option value="pendente">Pendente</option>
                <option value="aberta">Aberta</option>
            </select>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
        </div>
    </div>
</form>
@endsection
