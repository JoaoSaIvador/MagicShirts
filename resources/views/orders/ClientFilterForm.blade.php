@extends('admin.OrdersManagement')
@section('orders')
<div class="dropdown">
  <button class="dropbtn">Nº Cliente</button>
  <div class="dropdown-content">
     <a href="{{route('Orders.changefilter', ['Filter' => 'state'])}}"><button type="button" class="btn btn-primary launch">Estado</button></a>
     <a href="{{route('Orders.changefilter', ['Filter' => 'date'])}}"><button type="button" class="btn btn-primary launch">Data</button></a>
  </div>
</div>

<form action="{{route('Orders.filter', ['Filter' => $filtro])}}" method="GET" class="form-group">
@csrf
    <div class="input-group">
        <option value="estado">Estado
            <select name="valor" id="PLACEHOLDER">
                <option value="anulada">Anulada</option>
                <option value="fechada">Fechada</option>
                <option value="pendente">Pendente</option>
                <option value="aberta">Aberta</option>
            </select>
        </option>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
        </div>
    </div>
</form>
@endsection
