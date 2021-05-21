@extends('template')
@section('content')
<section class="h-100 h-custom">
  <div class="container-xl py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col">
        <div class="card">
          <div class="card-body p-4" style="background-color: #eee;">

            <div class="row">
              <div class="col-lg-7">
                <h4 class="mb-3">Carrinho</h4>
                <hr>

                
                <!-- Single item -->
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-lg-3 col-md-12 mb-4 mb-lg-0">
                        <!-- Image -->
                        <div class="bg-image hover-overlay hover-zoom ripple rounded" data-mdb-ripple-color="light">
                          <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12a.jpg" class="w-100" />
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
                            <option value="{{$id}}">{{$nome}}</option>
                            @endforeach
                          </select>
                        </div>

                        @foreach ($tamanhos as $abrev)
                        <div class="form-check form-check-inline" style=" margin-bottom: 10px;">
                          <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="{{$abrev}}">
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
                            <input id="form1" min="0" name="quantity" value="1" type="number" class="form-control" />
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
                  </div>
                </div>
              </div>
              <!-- Single item -->
              

              

              <div class="col-lg-5">
                <div class="card bg-primary text-white rounded-3">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h5 class="mb-0">Card details</h5>
                    </div>

                    <p class="small mb-2">Card type</p>
                    <a href="#!" type="submit" class="text-white"><i class="fa fa-cc-mastercard fa-2x"></i></a>
                    <a href="#!" type="submit" class="text-white"><i class="fa fa-cc-visa fa-2x"></i></a>
                    <a href="#!" type="submit" class="text-white"><i class="fa fa-cc-amex fa-2x"></i></a>
                    <a href="#!" type="submit" class="text-white"><i class="fa fa-cc-paypal fa-2x"></i></a>

                    <form class="mt-4">
                      <div class="form-outline form-white mb-4">
                        <input type="text" id="typeName" class="form-control form-control-lg" siez="17" placeholder="Cardholder's Name" />
                        <label class="form-label" for="typeName">Cardholder's Name</label>
                      </div>

                      <div class="form-outline form-white mb-4">
                        <input type="text" id="typeText" class="form-control form-control-lg" siez="17" placeholder="1234 5678 9012 3457" minlength="19" maxlength="19" />
                        <label class="form-label" for="typeText">Card Number</label>
                      </div>

                      <div class="row mb-4">
                        <div class="col-md-6">
                          <div class="form-outline form-white">
                            <input type="text" id="typeExp" class="form-control form-control-lg" placeholder="MM/YYYY" size="7" id="exp" minlength="7" maxlength="7" />
                            <label class="form-label" for="typeExp">Expiration</label>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-outline form-white">
                            <input type="password" id="typeText" class="form-control form-control-lg" placeholder="&#9679;&#9679;&#9679;" size="1" minlength="3" maxlength="3" />
                            <label class="form-label" for="typeText">Cvv</label>
                          </div>
                        </div>
                      </div>
                    </form>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Subtotal</p>
                      <p class="mb-2">$4798.00</p>
                    </div>

                    <div class="d-flex justify-content-between">
                      <p class="mb-2">Shipping</p>
                      <p class="mb-2">$20.00</p>
                    </div>

                    <div class="d-flex justify-content-between mb-4">
                      <p class="mb-2">Total(Incl. taxes)</p>
                      <p class="mb-2">$4818.00</p>
                    </div>

                    <button type="button" class="btn btn-info btn-block btn-lg">
                      <div class="d-flex justify-content-between">
                        <span>$4818.00</span>
                        <span>Checkout <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                      </div>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection