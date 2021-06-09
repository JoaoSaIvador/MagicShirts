@extends('home.dashboard')
@section('adminContent')
<div class="container">
    <div class="d-flex justify-content-start mb-4">
        <a class="btn btn-success btn-s mr-1" href="{{route('Colors.create')}}" role="button" aria-pressed="true">Adicionar Cor</a>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Cor</th>
                <th>Código</th>
                <th>Nome</th>
                <th>Opcional</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="bg-light">
            @foreach ($cores as $cor)
            <tr>
                <th><span class="color"  style="background-color: #{{$cor->codigo}}"></span></th>
                <td>{{$cor->codigo}}</td>
                <td>{{$cor->nome}}</td>
                <td>
                    <a href="{{route('Colors.edit', ['cor' => $cor])}}"><button type="button" class="btn btn-primary launch">Editar</button></a>
                </td>
                <td>
                    @if (is_null($cor->deleted_at))
                        <form action="{{route('Colors.delete', ['cor' => $cor])}}" method="post">
                            @csrf
                            @method("DELETE")
                                <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                        </form>
                    @else
                        <form action="{{route('Colors.restore', $cor)}}" method="POST">
                            @csrf
                                <input type="text" name="cor" hidden value="{{$cor->codigo}}">
                                <input type="submit" class="btn btn-warning btn-sm" value="Restaurar">
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    {{ $cores->withQueryString()->links() }}
    </div>
</div>
@endsection
