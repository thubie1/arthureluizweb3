@extends('template')

@section('conteudo')
  <h1>Cadastro de Pedido</h1>

  <form action="{{url('pedido/salvar')}}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
      <input type="hidden" name="id" value="{{$pedido->id}}">
    </div>
    <div class="mb-3">
      <input hidden type="number" step="any" name="valor_total" value="{{$pedido->valor_total}}">
    </div>
    <div class="mb-3">
      <label for="nome_cliente">Nome do Cliente</label>
      <input  class="form-control" type="text"name="nome_cliente" value="{{$pedido->nome_cliente}}">
    </div>
    <div class="mb-3">
      <label for="arquivo" class="form-label">Produtos</label>
      <select  name="produtos[]" multiple="multiple" class="form-control">
								@foreach($produtos as $produto)
									<option value="<?=$produto['id']?>">
										<?=$produto['nome']?></br>
									</option>
								@endforeach
							</select>
    </div>
    <div class="mb-3">
      <label for="funcionario_id" class="form-label">Funcionario</label>
      <select class="form-select @error('funcionario_id') is-invalid @enderror" name="funcionario_id">
        @foreach($funcionarios as $funcionario)
          <option {{ $funcionario->id == old('funcionario_id', $funcionario->funcionario_id) ?'selected': ''}} value="{{$funcionario->id}} ">{{$funcionario->nome}}</option>
        @endforeach
      </select>
      @error('funcionario_id')
          <div class="alert alert-danger">{{ $message }}</div>
      @enderror

    </div>

    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
  </form>
@endsection
