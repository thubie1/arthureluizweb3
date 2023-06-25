@extends('template')

@section('conteudo')
  <h1>Cadastro de Funcao</h1>
  @if ($funcao->imagem != "")
    <img style="width: 200px;height:200px;object-fit:cover" src="/storage/imagens/{{$funcao->imagem}}">
  @endif

  <form action="{{url('funcao/salvar')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3 @if($funcao->id==0) d-none @endif">
      <label for="id" class="form-label">ID</label>
      <input readonly class="form-control" readonly type="text" name="id" value="{{$funcao->id}}">
    </div>
    <div class="mb-3">
      <label for="id" class="form-label">Descrição</label>
      <input class="form-control" type="text" name="descricao" value="{{$funcao->descricao}}">
    </div>


    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
  </form>
@endsection
