@extends('template')

@section('conteudo')
  <h1>Listagem de Funcionarios</h1>
  <a href="novo" class="btn btn-primary">Novo</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Foto</th>
        <th>Nome</th>
        <th>Função</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($funcionarios as $funcionario)
          <tr>
            <td>{{$funcionario->id}}</td>
            <td>
              @if ($funcionario->foto != "")
                <img style="width: 250px;" src="/storage/imagens/{{$funcionario->foto}}">
              @endif            </td>
            <td>{{$funcionario->nome}}</td>
            <td>{{$funcionario->funcao->descricao}}</td>
            <td><a class='btn btn-primary' href='editar/{{$funcionario->id}}'>+</a></td>
            <td><a class='btn btn-danger' href='excluir/{{$funcionario->id}}'>-</a></td>
          </tr>
      @endforeach

   </tbody>
  </table>
@endsection
