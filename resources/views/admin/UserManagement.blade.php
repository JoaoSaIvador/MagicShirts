@extends('home.dashboard')
@section('adminContent')
<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>User Id</th>
                <th>Nome</th>
                <th>Data Inscrição</th>
                <th>Tipo</th>
                <th>Permissões</th>
                <th>Opcional</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="bg-light">
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->created_at}}</td>
                <td>{{$user->tipo}}</td>
                <td>
                    <button class="btn btn-success btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$user->id}}" aria-expanded="false" aria-controls="collapseOrder">
                        Alterar Permissões
                    </button>
                    <div class="collapse mb-n3 mt-2" id="collapse{{$user->id}}">
                        <form action="{{route('Users.permissions', ['user' => $user])}}" method="POST" class="form-group">
                        @csrf
                        @method('PUT')
                            <div class="row">
                                <select name="tipo" class="custom-select col">
                                    <option value="none" selected disabled hidden>Alterar permissões</option>
                                    @if ($user->tipo != "A")
                                        <option value="A">Admin</option>
                                    @endif
                                    @if ($user->tipo != "F")
                                        <option value="F">Funcionario</option>
                                    @endif
                                    @if ($user->tipo != "C")
                                        <option value="C">Cliente</option>
                                    @endif
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm col ml-1">Salvar</button>
                            </div>
                        </form>
                    </div>
                </td>
                <td>
                    <form action="{{route('Users.block', ['user' => $user])}}" method="post">
                        @csrf
                        @method('PUT')
                        @if ($user->bloqueado != "0")
                            <button type="submit" class="btn btn-primary btn-sm launch">Desbloquear</button>
                        @endif
                        @if ($user->bloqueado != "1")
                            <button type="submit" class="btn btn-primary btn-sm launch">Bloquear</button>
                        @endif
                    </form>
                </td>
                <td>
                    <form action="{{route('Users.delete', ['user' => $user])}}" method="post">
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
    {{ $users->withQueryString()->links() }}
    </div>
</div>
@endsection
