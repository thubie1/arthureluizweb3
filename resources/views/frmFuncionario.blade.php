@extends('template')

@section('conteudo')
  <h1>Cadastro de Funcionario</h1>
  @if ($funcionario->foto != "")
    <img style="width: 200px;height:200px;object-fit:cover" src="/storage/imagens/{{$funcionario->foto}}">
  @endif

  <form action="{{url('funcionario/salvar')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <label for="id" class="form-label">ID</label>
      <input readonly class="form-control" readonly type="text" name="id" value="{{$funcionario->id}}">
    </div>
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input class="form-control" type="text" name="nome" value="{{$funcionario->nome}}">
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Data de Nascimento</label>
      <input class="form-control" type="date" name="data_nascimento" value="{{$funcionario->data_nascimento}}">
    </div>
    <div class="mb-3">
      <label for="arquivo" class="form-label">Foto</label>
      <input class="form-control" type="file" name="arquivo" accept="image/*">
    </div>
    <div class="mb-3">
      <label for="funcao_id" class="form-label">Funcao</label>
      <select class="form-select @error('funcao_id') is-invalid @enderror" name="funcao_id">
        @foreach($funcoes as $funcao)
          <option {{ $funcao->id == old('funcao_id', $funcionario->funcao_id) ?'selected': ''}} value="{{$funcao->id}} ">{{$funcao->descricao}}</option>
        @endforeach
      </select>
      @error('funcao_id')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    </div>

    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
  </form>
@endsection
