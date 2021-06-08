@extends('template')
@section('content')
<div class="container">
    <div class="d-flex justify-content-start mb-4">
        <a class="btn btn-success btn-s mr-1" href="{{route('Stamps.create')}}" role="button" aria-pressed="true">Adicionar Estampa</a>
        <a class="btn btn-primary btn-s ml-1" href="{{ route('Catalogue') }}">Voltar</a>
    </div>
</div>
<div class="album">
    <div class="container-xl">
        <div class="row" style="justify-content: center;">
            @forelse ($estampas as $estampa)
                @include('partials.Catalogue-card')
                    <hr>
                        <div class="row">
                            <div class="col">
                                <a class="btn btn-primary btn-sm" href="{{route('Stamps.edit', ['estampa' => $estampa])}}" role="button" aria-pressed="true">Editar</a>
                            </div>
                            <div class="col">
                                <form action="{{route('Stamps.delete', ['estampa' => $estampa])}}" method="post">
                                    @csrf
                                    @method("DELETE")
                                        <input type="submit" class="btn btn-danger btn-sm" value="Apagar">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p class="display-4 font-weight-bold">Não existem estampas</p>
            @endforelse
            <div class="d-flex justify-content-center">
                {{ $estampas->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
