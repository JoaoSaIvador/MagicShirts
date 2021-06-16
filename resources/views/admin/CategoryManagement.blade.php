@extends('home.dashboard')
@section('title', 'Categorias')
@section('adminContent')
<div class="container">
    <div class="d-flex justify-content-start mb-4">
        <a class="btn btn-success btn-s mr-1" href="{{route('Categories.create')}}" role="button" aria-pressed="true">Adicionar Categoria</a>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Opcional</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="bg-light">
            @foreach ($categorias as $categoria)
            <tr>
                <td>{{$categoria->id}}</td>
                <td>{{$categoria->nome}}</td>
                <td>
                    <a href="{{route('Categories.edit', ['categoria' => $categoria])}}"><button type="button" class="btn btn-primary launch">Editar</button></a>
                </td>
                <td>
                    @if (is_null($categoria->deleted_at))
                        <form action="{{route('Categories.delete', ['categoria' => $categoria])}}" method="post">
                            @csrf
                            @method("DELETE")
                                <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                        </form>
                    @else
                        <form action="{{route('Categories.restore', $categoria)}}" method="POST">
                        @csrf
                                <input type="text" name="categoria" hidden value="{{$categoria->id}}">
                                <input type="submit" class="btn btn-warning btn-sm" value="Restaurar">
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    {{ $categorias->withQueryString()->links() }}
    </div>
</div>
@endsection
