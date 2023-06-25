<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Funcionario;
use App\Models\Funcao;
use Illuminate\Support\Facades\Storage;

class FuncionarioController extends Controller
{
  function listar() {
    $funcionarios = Funcionario::orderBy('nome')->get();
    
    return view('listagemFuncionario',
                  compact('funcionarios'));
  }

  function novo() {
    $funcionario = new Funcionario();
    $funcionario->id = 0;
    $funcoes = Funcao::orderBy('descricao')->get();
    return view('frmFuncionario', compact('funcionario', 'funcoes'));
  }

  function salvar(Request $request) {
    if ($request->input('id') == 0) {
      $funcionario = new Funcionario();
    } else {
      $funcionario = Funcionario::find($request->input('id'));
    }
    if ($request->hasFile('arquivo')) {
        $file = $request->file('arquivo');
        $upload = $file->store('public/imagens');
        $upload = explode("/", $upload);
        $tamanho = sizeof($upload);
        if ($funcionario->foto != "") {
          Storage::delete("public/imagens/".$funcionario->foto);
        }
        $funcionario->foto = $upload[$tamanho-1];
    }


    $funcionario->nome = $request->input('nome');
    $funcionario->data_nascimento = $request->input('data_nascimento');
    $funcionario->funcao_id = $request->input('funcao_id');
    $funcionario->save();
    return redirect('funcionario/listar');
  }

  function editar($id) {
    $funcionario = Funcionario::find($id);
    $funcoes = Funcao::orderBy('descricao')->get();
    return view('frmFuncionario', compact('funcionario', 'funcoes'));
  }

  function excluir($id) {
    $funcionario = Funcionario::find($id);
    if ($funcionario->foto != "") {
      Storage::delete("public/imagens/".$funcionario->foto);
    }
    $funcionario->delete();
    return redirect('funcionario/listar');
  }

  function mensagem($id) {
    $funcionario = Funcionario::find($id) ;
    return view('frmMensagem', compact('funcionario'));

  }

  function enviarMensagem(Request $request) {
    $id = $request->input('id');
    $mensagem = $request->input('mensagem');
    $funcionario = Funcionario::find($id) ;
    Mail::to($funcionario->email)->send(new FuncionarioMensagem($funcionario, $mensagem));
    return redirect('funcionario/listar');
  }


}
