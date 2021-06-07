@extends('home.dashboard')
@section('adminContent')
<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Estampa Id</th>
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
                <td>{{$estampa->nome}}</td>
                <td>{{$estampa->categoria->nome}}</td>
                <td>
                    <a href="{{route('Stamps.edit', ['estampa' => $estampa])}}"><button type="button" class="btn btn-primary launch">Editar</button></a>
                </td>
                <td>
                    <form action="{{route('Stamps.delete', ['estampa' => $estampa])}}" method="post">
                        @csrf
                        @method("DELETE")
                            <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    {{ $estampas->withQueryString()->links() }}
    </div>
</div>
@endsection
