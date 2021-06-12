@extends('template')
@section('content')


<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
    <div class="view overlay">
      
            <img class="card-img-top estampa-img" id="card-img-top" src="{{asset('img/Carrousel2.jpg')}}" alt="Imagem da Estampa">
        
        <div class="mask rgba-white-slight"></div>
    </div>
    </div>
    @forelse ($estampas as $estampa)

    <div class="carousel-item">
      <img class="card-img-top estampa-img" id="card-img-top" src="{{$estampa->getImagemFullUrl()}}" alt="Imagem da Estampa">
    </div>
    
    @empty
        <p class="display-4 font-weight-bold">Não existem estampas</p>
    @endforelse
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
