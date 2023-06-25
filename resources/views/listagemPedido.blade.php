@extends('template')



@section('conteudo')
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif


  <h1>Listagem de pedidos</h1>
  <a href="novo" class="btn btn-primary">Novo</a>
  <a href="relatorio" class="btn btn-primary">Relatório</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Funcionario</th>
        <th>Horário</th>
        <th>Produtos</th>
        <th>Valor Total</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($pedidos as $pedido)
          <tr>
          <td>{{$pedido->id}}</td>
          <td>{{$pedido->nome_cliente}}</td>
            <td>{{$pedido->funcionario->nome}}</td>
            <td>{{$pedido->horario}}</td>
            <td>
            @foreach($pedido->produtos as $produto) 
            @if ($loop->last)
            {{$produto->nome}}
            @else
            {{$produto->nome}},
          @endif
              <p style="display:none;">{{$pedido->valor_total+=$produto->valor}}</p>
          
            @endforeach</td>
            <td>{{$pedido->valor_total}}</td>
            <td><a class='btn btn-danger' href='excluir/{{$pedido->id}}'>-</a></td>
          </tr>
      @endforeach

   </tbody>
  </table>
@endsection
