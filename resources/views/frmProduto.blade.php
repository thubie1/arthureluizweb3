@extends('template')

@section('conteudo')
  <h1>Cadastro de produto</h1>
  @if ($produto->imagem != "")
    <img style="width: 200px;height:200px;object-fit:cover" src="/storage/imagens/{{$produto->imagem}}">
  @endif

  <form action="{{url('produto/salvar')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="id" class="form-label">ID</label>
      <input readonly class="form-control" readonly type="text" name="id" value="{{$produto->id}}">
    </div>
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input class="form-control" type="text" name="nome" value="{{$produto->nome}}">
    </div>
    <div class="mb-3">
      <label for="arquivo" class="form-label">Foto</label>
      <input class="form-control" type="file" name="arquivo" accept="image/*">
    </div>
    <div class="mb-3">
      <label for="arquivo" class="form-label">Preço</label>
      <input class="form-control" type="number" step="any" name="valor" value="{{$produto->valor}}">
    </div>
    <div class="mb-3">
      <label for="categoria_id" class="form-label">Categoria</label>
      <select class="form-select @error('categoria_id') is-invalid @enderror" name="categoria_id">
        @foreach($categorias as $categoria)
          <option {{ $categoria->id == old('categoria_id', $produto->categoria_id) ?'selected': ''}} value="{{$categoria->id}} ">{{$categoria->descricao}}</option>
        @endforeach
      </select>
      @error('categoria_id')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    </div>

    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
  </form>
@endsection
