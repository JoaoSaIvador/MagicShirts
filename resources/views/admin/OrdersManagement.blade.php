@extends('home.dashboard')
@section('title', 'Encomendas')
@section('adminContent')
<div class="container">
    <div class="col-5 ">
        <form method="GET" action="#" class="form-group">
            <div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect1">Example select</label>
                <select class="form-control" id="exampleFormControlSelect1">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlSelect2">Example multiple select</label>
                <select multiple class="form-control" id="exampleFormControlSelect2">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
              </div>
        </form>
    </div>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Id da Encomenda</th>
                <th>Estado</th>
                <th>Data</th>
                <th>Preço Total</th>
                <th>Opcional</th>
                <th></th>
            </tr>
        </thead>
        <tbody class="bg-light">
            @foreach ($encomendas as $encomenda)
            <tr>
                <td>{{$encomenda->id}}</td>
                <td>{{$encomenda->estado}}</td>
                <td>{{$encomenda->data}}</td>
                <td>${{$encomenda->preco_total}}</td>
                <td>
                    <a href="{{route('Orders.view', ['encomenda' => $encomenda])}}"><button type="button" class="btn btn-primary launch">Detalhes</button></a>
                </td>
                <td>
                    @if (auth()->user()->tipo == 'A' || $encomenda->estado != "anulada")
                        <button class="btn btn-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$encomenda->id}}" aria-expanded="false" aria-controls="collapseOrder">
                            Alterar
                        </button>
                        <div class="collapse mb-n3 mt-2" id="collapse{{$encomenda->id}}">
                            <form action="{{route('Orders.update', ['encomenda' => $encomenda])}}" method="POST" class="form-group">
                            @csrf
                            @method('PATCH')
                                <div class="row">
                                    <select name="estado" class="custom-select col">
                                        <option value="none" selected disabled hidden>Alterar Estado</option>
                                        @if ($encomenda->estado == "pendente")
                                            <option value="paga">Paga</option>
                                        @endif
                                        @if ($encomenda->estado == "paga")
                                            <option value="fechada">Fechada</option>
                                        @endif
                                        @if (auth()->user()->tipo == 'A')
                                            <option value="anulada">Anulada</option>
                                        @endif
                                    </select>
                                    <button type="submit" class="btn btn-primary btn-sm col ml-1">Save</button>
                                </div>
                            </form>
                        </div>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    {{ $encomendas->withQueryString()->links() }}
    </div>
</div>
@endsection
