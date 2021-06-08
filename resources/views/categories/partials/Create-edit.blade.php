<div class="form-group">
    <label for="inputNome" class="fs-2">Nome da Categoria</label>
    <input type="text" class="form-control" name="nome" id="inputNome" value="{{old('nome', $categoria->nome)}}">
    @error('nome')
       <div class="small text-danger">{{$message}}</div>
    @enderror
</div>
