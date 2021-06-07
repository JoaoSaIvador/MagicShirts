<div class="album">
    <div class="container-xl">
        <div class="row" style="justify-content: center;">
            @forelse ($estampas as $estampa)
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
                        <hr>
                        @auth
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-primary btn-sm" href="{{route('Catalogue.edit', ['estampa' => $estampa])}}" role="button" aria-pressed="true">Editar</a>
                            </div>
                            <div class="col">
                                <form action="{{route('Catalogue.destroy', ['estampa' => $estampa])}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                                </form>
                            </div>
                        </div>
                        @endauth
                    </div>
                </div>
            @empty
            <p class="display-4 font-weight-bold">Não existem estampas</p>
            @endforelse
        </div>
        <div class="d-flex justify-content-center">
            {{ $estampas->withQueryString()->links() }}
        </div>
    </div>
</div>
