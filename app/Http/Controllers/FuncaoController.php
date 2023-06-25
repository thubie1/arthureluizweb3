<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Funcao;

class FuncaoController extends Controller
{
    //
    function listar() {
      $funcoes = Funcao::orderBy('descricao')->get();
      return view('listagemFuncao',
                    compact('funcoes'));
    }

    function novo() {
      $funcao = new Funcao();
      $funcao->id = 0;
      $funcao->descricao = "";
      return view('frmFuncao', compact('funcao'));
    }

    function salvar(Request $request) {
      if ($request->input('id') == 0) {
        $funcao = new Funcao();
      } else {
        $funcao = Funcao::find($request->input('id'));
      }

      $funcao->descricao = $request->input('descricao');
      $funcao->save();
      return redirect('funcao/listar');
    }

    function editar($id) {
      $funcao = Funcao::find($id);
      return view('frmFuncao', compact('funcao'));
    }

    function excluir($id) {
      $funcao = Funcao::find($id);
      try {
        $funcao->delete();
      } catch(\Exception $e) {
        return redirect('funcao/listar')->with(['msg' => 'Funcao não pode ser excluída']);
      }
      return redirect('funcao/listar')->with(['msg'=> 'Funcao excluída']);

    }
}
