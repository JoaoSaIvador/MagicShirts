@extends('home.dashboard')
@section('adminContent')
<div class="container">
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Nº Cliente</th>
                <th>Nome</th>
                <th>Data Inscrição</th>
                <th>Permissões</th>
                <th>Opcional</th>
            </tr>
        </thead>
        <tbody class="bg-light">
            @foreach ($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->created_at}}</td>
                <td>
                    <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$user->id}}" aria-expanded="false" aria-controls="collapseOrder">
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
                                        <option value="paga">Admin</option>
                                    @endif
                                    @if ($user->tipo != "F")
                                        <option value="fechada">Funcionario</option>
                                    @endif
                                    @if ($user->tipo != "C")
                                        <option value="fechada">Cliente</option>
                                    @endif
                                </select>
                                <button type="submit" class="btn btn-primary btn-sm col ml-1">Salvar</button>
                            </div>
                        </form>
                    </div>
                </td>
                <td>
                @if ($user->bloqueado != "0")
                    <a href="{{route('users.block', ['user' => $user])}}"><button type="button" class="btn btn-primary launch">Bloquear</button></a>
                @endif
                @if ($user->bloqueado != "1")
                    <a href="{{route('users.unblock', ['user' => $user])}}"><button type="button" class="btn btn-primary launch">Desbloquear</button></a>
                @endif 
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
