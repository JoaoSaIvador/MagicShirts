@extends('admin.Orders')
@section('orders')
<div class="col-5 ">
        <form method="GET" action="#" class="form-group">
            <div class="input-group">
                <select class="custom-select" id="idFiltro">
                    <option value="none" selected disabled hidden>Filtrar por</option>
                    <option value="" >Sem Filtro</option>
                    <option value="cliente_id">Cliente Id

                    </option>
                    <option value="estado">Estado
                        <select name="valor" id="PLACEHOLDER">
                            <option value="anulada">Anulada</option>
                            <option value="fechada">Fechada</option>
                            <option value="pendente">Pendente</option>
                            <option value="aberta">Aberta</option>
                        </select>
                    </option>
                    <option value="data">Data

                    </option>
                </select>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Filtrar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
