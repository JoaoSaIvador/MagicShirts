@extends('template')
@section('content')
<section class="h-100 gradient-custom">
  <div class="container py-5">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Carrinho de compras ({{empty($carrinho) ? 0 : $carrinho['quantidadeItens']}})</h5>
          </div>
          <div class="card-body">
            @if (!empty($carrinho) && $carrinho['quantidadeItens'] != 0)
            @foreach ($carrinho['items'] as $key=>$row)

            <form action="{{route('Cart.destroy', $key)}}" method="POST" id="formDelete_{{$key}}">
              @csrf
              @method('DELETE')
            </form>
            <form action="{{route('Cart.update', $key)}}" method="POST" id="formUpdate_{{$key}}">
              @csrf
              @method('PATCH')
              {{-- Single item --}}
              <div class="row">
                <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                  {{-- Image --}}
                  <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                    <img src="{{$row['imagem']}}" class="w-100" />
                    <a href="#!">
                      <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                    </a>
                  </div>
                  {{-- Image --}}
                </div>

                <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                  {{-- Data --}}
                  <h5>{{$row['nome']}} T-shirt</h5>
                  <div class="cart-select" style="margin-bottom: 10px;">
                    <p class="text-start text-md-left" style="margin-bottom: 0px;">Cores:</p>
                    <select class="custom-select " name="cor_codigo">
                      @foreach ($cores as $id => $nome)
                      <option value="{{$id}}" {{$id == $row['cor_codigo'] ? 'selected' : ''}}>{{$nome}}</option>
                      @endforeach
                    </select>
                  </div>

                  <p class="text-start text-md-left" style="margin-bottom: 0px;">Tamanho:</p>
                  @foreach ($tamanhos as $abrev)
                  <div class="form-check form-check-inline" style=" margin-bottom: 10px;">
                    <input class="form-check-input" type="radio" name="{{$key}}" id="inlineRadio1" value="{{$abrev}}" {{$abrev == $row['tamanho'] ? 'checked="checked"' : ''}}>
                    <label class="form-check-label" for="inlineRadio1">{{$abrev}}</label>
                  </div>
                  @endforeach
                  {{-- Data --}}

                  <button type="submit" class="btn btn-primary cart-update" form="formUpdate_{{$key}}">Atualizar</button>
                </div>
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                  {{-- Quantity --}}
                  <div class="d-flex mb-4 cart-quantity">
                    <div class="form-outline">
                      <label class="form-label" style="margin-bottom: 0px;">Quantidade:</label>
                      <input id="form1" min="0" name="quantidade" value="{{$row['quantidade']}}" type="number" class="form-control" />
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm me-1 mb-2 cart-remove" data-mdb-toggle="tooltip" form="formDelete_{{$key}}">
                      <i class="fa fa-trash-o"></i>
                    </button>

                  </div>
                  {{-- Quantity --}}
                  {{-- Price --}}
                  <h6 class="cart-price">Preço (unid):</h6>
                  <p class="text-start text-md-left cart-price">
                    <strong>${{$row['preco_un']}}</strong>
                  </p>
                  <br>
                  <h6 class="cart-price">Subtotal:</h6>
                  <p class="text-start text-md-left cart-price">
                    <strong>${{$row['subtotal']}}</strong>
                  </p>
                  {{-- Price --}}
                </div>
              </div>
              {{-- Single item --}}
            </form>

            @if (!$loop->last)
            <hr class="my-4" />
            @endif
            @endforeach
            @else
            <h5>Carrinho vazio</h5>
            @endif
          </div>

        </div>
      </div>
      <div class="col-md-4">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Sumário</h5>
          </div>
          <div class="card-body">
            <ul class="list-group list-group-flush">
              @if (!empty($carrinho) && $carrinho['quantidadeItens'] != 0)
              @foreach ($carrinho['items'] as $row)
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                {{$row['nome']}} T-shirt ({{$row['quantidade']}}):
                <span>${{$row['subtotal']}}</span>
              </li>
              @endforeach
              @endif
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Preço Final:</strong>
                </div>
                <span><strong>${{$carrinho['precoTotal'] ?? 0}}</strong></span>
              </li>
            </ul>
            @if (!empty($carrinho) && $carrinho['quantidadeItens'] != 0)
            <a href="{{route('Checkout')}}" class="btn btn-primary btn-lg btn-block">
              Ir para o checkout
            </a>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
