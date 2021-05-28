@extends('template')
@section('content')
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <div class="album">
        <div class="container-xl">
          <div class="row" style="justify-content: center;">
            <div class="card col-lg-3 m-2">
              <div class="view overlay">
                <img class="card-img-top estampa-img" id="card-img-top" src="{{asset('img/Carrousel1.jpg')}}" alt="Imagem da Estampa">
              </div>
            </div>
        </div>
      </div>
    </div>

    <div class="carousel-item">
    <div class="album">
        <div class="container-xl">
          <div class="row" style="justify-content: center;">
            <div class="card col-lg-3 m-2">
              <div class="view overlay">
                <img class="card-img-top estampa-img" id="card-img-top" src="{{asset('img/Carrousel3.jpg')}}" alt="Imagem da Estampa">
              </div>
            </div>
        </div>
      </div>
    </div>
    <div class="carousel-item">
    <div class="album">
        <div class="container-xl">
          <div class="row" style="justify-content: center;">
            <div class="card col-lg-3 m-2">
              <div class="view overlay">
                <img class="card-img-top estampa-img" id="card-img-top" src="{{asset('img/Carrousel2.jpg')}}" alt="Imagem da Estampa">
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>



<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="{{asset('img/Carrousel1.jpg')}}" class="d-block w-100" alt="Shirt">
    </div>
    <div class="carousel-item">
      <img src="{{asset('img/Carrousel2.jpg')}}" class="d-block w-100" alt="Shirt">
    </div>
    <div class="carousel-item">
      <img src="{{asset('img/Carrousel3.jpg')}}" class="d-block w-100" alt="Shirt">
    </div>
    <div class="carousel-item">
      <img src="{{asset('img/Carrousel4.jpg')}}" class="d-block w-100" alt="Shirt">
    </div>
    <div class="carousel-item">
      <img src="{{asset('img/Carrousel5.jpg')}}" class="d-block w-100" alt="Shirt">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

@endsection
