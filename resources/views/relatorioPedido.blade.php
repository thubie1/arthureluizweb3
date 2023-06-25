<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title></title>
    <style>
      * {
        font-family: arial, sans-serif;
      }
      h1 {
        font-size: 3rem;
        text-align: center;
      }
      table {
        width: 80%;
        margin: 0 auto;
        border-collapse: collapse;
      }
      th, td {
        border: solid 1px gray;
        padding: 0.5rem;
        font-size: 1.5rem;
        text-align: center;
      }
    </style>
  </head>
  <body>
    <h1>Relatório de Pedido</h1>
    <table>
      <thead>
      <tr>
        <th>ID</th>
        <th>Cliente</th>
        <th>Funcionario</th>
        <th>Horário</th>
        <th>Produtos</th>
        <th>Valor Total</th>
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
          </tr>
      @endforeach
      </tbody>
    </table>
  </body>
</html>
