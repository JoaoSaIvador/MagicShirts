<div class="form-group">
    <label for="inputNome" class="fs-2">Nome da Cor</label>
    <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $cor->nome)}}">
    @error('nome')
       <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
<div class="form-group">
    <label for="inputDescricao" class="fs-2">Código</label>
    <input type="color" class="form-control" name="codigo" id="inputDescricao" value="#{{old('codigo', $cor->codigo)}}">
    @error('descricao')
       <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
