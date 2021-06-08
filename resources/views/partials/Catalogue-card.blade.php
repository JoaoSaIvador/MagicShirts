<div class="card col-lg-3 m-2">
    <div class="view overlay">
        <a href="{{route('Catalogue.view', ['estampa' => $estampa])}}">
            <img class="card-img-top estampa-img" id="card-img-top" src="{{$estampa->getImagemFullUrl()}}" alt="Imagem da Estampa">
        </a>
        <div class="mask rgba-white-slight"></div>
    </div>
    <hr>
    <div class="card-body text-center">
        <h5>{{$estampa->nome}}</h5>
