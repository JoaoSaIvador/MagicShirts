@extends('admin.OrdersManagement')
@section('orders')

  <div class="mb-2">
     <a href="{{route('Orders.changefilter', ['Filter' => 'cliente'])}}"><button type="button" class="btn btn-primary launch">Nº Cliente</button></a>
     <a href="{{route('Orders.changefilter', ['Filter' => 'estado'])}}"><button type="button" class="btn btn-primary launch">Estado</button></a>
  </div>

<form action="{{route('Orders.filter', ['Filter' => $filtro])}}" method="GET" class="form-group">
@csrf
    <div class="input-group">
            <select name="valor" class="form-control">
                <option value="asc">Ordenar Ascendente</option>
                <option value="desc">Ordenar Descendente</option>
            </select>
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
        </div>
    </div>
</form>
@endsection
