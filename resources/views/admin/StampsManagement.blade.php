@extends('home.dashboard')
@section('adminContent')
<div class="container">
    <div class="d-flex justify-content-start mb-4">
        <a class="btn btn-success btn-s mr-1" href="{{route('Stamps.create')}}" role="button" aria-pressed="true">Adicionar Estampa</a>
        <a class="btn btn-dark btn-s mr-1" href="{{route('Stamps.private')}}" role="button" aria-pressed="true">Estampas Próprias</a>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Estampa Id</th>
                <th>Cliente</th>
                <th>Nome</th>
                <th>Categoria</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody class="bg-light">
            @foreach ($estampas as $estampa)
            <tr>
                <td>{{$estampa->id}}</td>
                <td>{{$estampa->cliente->user->name ?? 'NULL'}}</td>
                <td>{{$estampa->nome}}</td>
                <td>{{$estampa->categoria->nome ?? 'NULL'}}</td>
                @if (is_null($estampa->cliente_id))
                    <td>
                        <a href="{{route('Stamps.edit', ['estampa' => $estampa])}}"><button type="button" class="btn btn-primary launch">Editar</button></a>
                    </td>
                    <td>
                        @if (is_null($estampa->deleted_at))
                            <form action="{{route('Stamps.delete', ['estampa' => $estampa])}}" method="post">
                                @csrf
                                @method("DELETE")
                                    <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                            </form>
                        @else
                            <form action="{{route('Stamps.restore', $estampa)}}" method="POST">
                                @csrf
                                    <input type="text" name="estampa" hidden value="{{$estampa->id}}">
                                    <input type="submit" class="btn btn-warning btn-sm" value="Restaurar">
                            </form>
                        @endif
                    </td>
                @else
                    <td></td>
                    <td></td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    {{ $estampas->withQueryString()->links() }}
    </div>
</div>
@endsection
