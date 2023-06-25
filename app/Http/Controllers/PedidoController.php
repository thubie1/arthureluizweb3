<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Funcionario;
use App\Models\PedidoProduto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;
use Barryvdh\DomPDF\Facade\Pdf;

class PedidoController extends Controller
{
    //
    function listar() {
      $pedidos = Pedido::with('produtos')->get();
    
      return view('listagemPedido',
                    compact('pedidos'));
    }

    function novo() {
      $pedido = new Pedido();
      $pedido->id = 0;
      $pedido->valor_total = 0;
      $produtos = Produto::orderBy('nome')->get();
      $funcionarios = Funcionario::orderBy('nome')->get();
      return view('frmPedido', compact('pedido', 'produtos', 'funcionarios'));
    }

    function salvar(Request $request) {
      
      if ($request->input('id') == 0) {
        $pedido = new Pedido();
      } else {
        $pedido = Pedido::find($request->input('id'));
      }
      $pedido->nome_cliente= $request->input('nome_cliente');
      $pedido->valor_total = floatval($request->input('valor_total'));
      $pedido->funcionario_id = $request->input('funcionario_id');
      date_default_timezone_set('America/Manaus');
      $pedido->horario = date('H:i');
      $pedido->save();
      $pedido->id;
      $produtos = $request->input('produtos');
      $pedido->produtos()->attach($produtos);
      
      
      return redirect('pedido/listar');
    }

    function excluir($id) {
      $pedido = Pedido::find($id);
      try {
        $pedido->delete();
      } catch(\Exception $e) {
        return redirect('pedido/listar')->with(['msg' => 'Pedido não pode ser excluído']);
      }
      return redirect('pedido/listar')->with(['msg'=> 'Pedido excluído']);

    }

    function relatorio() {
      $pedidos = Pedido::orderBy('id')->get();
      $pdf = Pdf::loadView('relatorioPedido', compact('pedidos'));
      return $pdf->download('pedidos.pdf');
    }
}
