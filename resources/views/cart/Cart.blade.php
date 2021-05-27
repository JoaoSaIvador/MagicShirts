@extends('template')
@section('content')
<section class="h-100 gradient-custom">
  <div class="container py-5">
    <div class="row d-flex justify-content-center my-4">
      <div class="col-md-8">
        <div class="card mb-4">
          <div class="card-header py-3">
            <h5 class="mb-0">Carrinho de compras</h5>
          </div>
          <div class="card-body">

          @foreach ($carrinho as $row)

            <!-- Single item -->
            <div class="row">
              <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                <!-- Image -->
                <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                  <img src="{{asset('storage/estampas/' . $estampas[$row['estampa_id']])}}" class="w-100" />
                  <a href="#!">
                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.2)"></div>
                  </a>
                </div>
                <!-- Image -->
              </div>

              <div class="col-lg-5 col-md-6 mb-4 mb-lg-0">
                <!-- Data -->
                <h5>Blue denim shirt</h5>
                <div class="cart-select" style="margin-bottom: 10px;">
                  <select class="custom-select " name="color_id">
                    @foreach ($cores as $id => $nome)
                    <option value="{{$id}}" {{$id == $row['cor_codigo'] ? 'selected' : ''}}>{{$nome}}</option>
                    @endforeach
                  </select>
                </div>

                @foreach ($tamanhos as $abrev)
                <div class="form-check form-check-inline" style=" margin-bottom: 10px;">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="{{$abrev}}" {{$abrev == $row['tamanho'] ? 'checked="checked"' : ''}}>
                  <label class="form-check-label" for="inlineRadio1">{{$abrev}}</label>
                </div>
                @endforeach

                <button type="button" class="btn btn-primary btn-sm me-1 mb-2" data-mdb-toggle="tooltip" title="Remove item">
                  <i class="fa fa-trash-o"></i>
                </button>
                <!-- Data -->
              </div>

              <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                <!-- Quantity -->
                <div class="d-flex mb-4 " style="width: 100px">
                  <div class="form-outline">
                    <label class="form-label" for="form1">Quantity:</label>
                    <input id="form1" min="0" name="quantity" value="{{$row['quantidade']}}" type="number" class="form-control" />
                  </div>
                </div>
                <!-- Quantity -->

                <!-- Price -->
                <h6>Preço:</h6>
                <p class="text-start text-md-left">
                  <strong>${{$preco->preco_un_catalogo}}</strong>
                </p>
                <!-- Price -->
              </div>
            </div>
            <!-- Single item -->

            <hr class="my-4" />

            @endforeach

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
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                Products
                <span>$53.98</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                Shipping
                <span>Gratis</span>
              </li>
              <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">
                <div>
                  <strong>Total amount</strong>
                  <strong>
                    <p class="mb-0">(including VAT)</p>
                  </strong>
                </div>
                <span><strong>$53.98</strong></span>
              </li>
            </ul>

            <button type="button" class="btn btn-primary btn-lg btn-block">
              Go to checkout
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
