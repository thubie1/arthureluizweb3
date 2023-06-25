@extends('template')

@section('conteudo')
  <h1>Listagem de Produtos</h1>
  <a href="novo" class="btn btn-primary">Novo</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Imagem</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Categoria</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($produtos as $produto)
          <tr>
            <td>{{$produto->id}}</td>
            <td>
              @if ($produto->imagem != "")
                <img style="width: 50px;" src="/storage/imagens/{{$produto->imagem}}">
              @endif            </td>
            <td>{{$produto->nome}}</td>
            <td>{{$produto->valor}}</td>
            <td>{{$produto->categoria->descricao}}</td>
            <td><a class='btn btn-primary' href='editar/{{$produto->id}}'>+</a></td>
            <td><a class='btn btn-danger' href='excluir/{{$produto->id}}'>-</a></td>
          </tr>
      @endforeach

   </tbody>
  </table>
@endsection
