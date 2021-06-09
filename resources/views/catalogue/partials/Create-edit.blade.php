<div class="form-group">
    <label for="inputNome" class="fs-2">Nome</label>
    <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $estampa->nome)}}">
    @error('nome')
       <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
@if (auth()->user()->tipo == 'A')
<div class="form-group">
    <label for="inputCategoria" class="fs-2">Categoria</label>
    <select class="custom-select" name="categoria_id" id="idCategoria">
        <option value="none" selected disabled hidden>Tipo de Categoria</option>
        <option value="" >Sem Categoria</option>
        @foreach ($categorias as $id => $nome)
            <option value="{{$id}}"
                {{old('categoria_id', $estampa->categoria_id) == $id ? 'selected' : ''}}>{{$nome}}
            </option>
        @endforeach
    </select>
</div>
@endif
<div class="form-group">
    <label for="inputDescricao" class="fs-2">Descrição</label>
    <input type="text" class="form-control" name="descricao" id="inputDescricao" value="{{old('descricao', $estampa->descricao)}}">
    @error('descricao')
       <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputImagem" class="fs-2">Imagem da Estampa</label>
    <input type="file" class="form-control" name="imagem_url" id="inputImagem" value="{{old('imagem_url', $estampa->getImagemFullUrl())}}">
    @error('imagem_url')
       <div class="small text-danger">{{$message}}</div>
    @enderror
</div>


