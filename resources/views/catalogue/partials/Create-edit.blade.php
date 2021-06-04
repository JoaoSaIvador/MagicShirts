<div class="form-group">
    <label for="inputNome">Nome</label>
    <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $estampa->nome)}}">
    @error('nome')
       <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputDescricao">Descrição</label>
    <input type="text" class="form-control" name="descricao" id="inputDescricao" value="{{old('descricao', $estampa->descricao)}}">
    @error('descricao')
       <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputImagem">Imagem da Estampa</label>
    <input type="file" class="form-control" name="imagem_url" id="inputImagem" value="{{old('imagem_url', $estampa->imagem_url)}}">
    @error('imagem_url')
       <div class="small text-danger">{{$message}}</div>
    @enderror
</div>

