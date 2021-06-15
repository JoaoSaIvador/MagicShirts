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
                  <div class="bg-image hover-overlay hover-zoom ripple rounded preview" data-mdb-ripple-color="light">
                    <svg id="product-preview-svg" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 612 586">
                      <path style="fill: #{{$row['cor_codigo']}}" d="M14.74 163.94l35.49-21.29 26.45-21.29 29.68-25.81 27.09-21.94 20.65-17.42 27.74-14.84 27.1-6.45 34.19-13.54 8.39-2.59 5.8 5.16 8.39 5.17 10.32 5.16L287 36.19l14.19 1.94h11.62l12.25-.65 9.04-1.93 9.03-3.87 5.81-3.23 5.16-5.16 3.22-1.29h5.81l8.39 2.58 14.19 5.81 14.84 4.51 14.19 3.87L427 42.65l9.03 2.58 10.33 5.8 12.9 8.39 10.97 9.03 10.32 9.03 13.55 13.88 14.19 10 11.61 9.03 10.33 7.09 12.25 8.39 12.91 7.74 12.25 8.39 10.33 5.81 7.74 5.8 10.32 6.45v3.88l-10.96 10.32-12.26 12.26-9.68 12.25-11.61 12.91-11.62 13.55-8.38 11.61-7.1 12.26-14.19-5.81-10.33-5.81-9.03-7.09-9.03-5.81h-7.74l-7.1 3.23v8.38l.64 17.42 1.3 6.45V316.19l.64 15.49 1.29 17.42v21.29l1.29 30.97.65 17.41.64 21.29 1.29 18.71.65 13.55.64 13.55 1.29 15.49.65 10.32v12.9l1.93 11.61.65 8.39.64 9.03h-9.67l-14.84-3.22-27.74-.65h-19.36l-20.64 3.87H256.03l-35.48-3.22-20-.65h-19.36l-31.61.65.65-37.42-1.94-49.68-.64-39.35v-100l-3.23-44.52-3.23-40 3.23-20-5.16 1.29-9.03 7.1-10.97 6.45-11.62 10.97-12.9 11.61-9.03-14.19-8.39-7.75-11.61-15.48-14.19-11.61-11.62-11.62L27 180.71l-12.26-16.77z" />
                    </svg>
                    <img src="storage/tshirt_base/default.jpg" id="product-preview" />
                    <img src="{{$row['imagem']}}" class="preview-stamp" />
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