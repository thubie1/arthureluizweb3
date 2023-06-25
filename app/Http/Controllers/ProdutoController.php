<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class ProdutoController extends Controller
{
  function listar() {
    $produtos = Produto::orderBy('nome')->get(); 
    return view('listagemProduto',
                  compact('produtos'));
  }

  function novo() {
    $produto = new Produto();
    $produto->id = 0;
    $categorias = Categoria::orderBy('descricao')->get();
    return view('frmProduto', compact('produto', 'categorias'));
  }

  function salvar(Request $request) {
    if ($request->input('id') == 0) {
      $produto = new Produto();
    } else {
      $produto = Produto::find($request->input('id'));
    }
    if ($request->hasFile('arquivo')) {
        $file = $request->file('arquivo');
        $upload = $file->store('public/imagens');
        $upload = explode("/", $upload);
        $tamanho = sizeof($upload);
        if ($produto->imagem != "") {
          Storage::delete("public/imagens/".$produto->imagem);
        }
        $produto->imagem = $upload[$tamanho-1];
    }


    $produto->nome = $request->input('nome');
    $produto->valor = $request->input('valor');
    $produto->categoria_id = $request->input('categoria_id');
    $produto->save();
    return redirect('produto/listar');
  }

  function editar($id) {
    $produto = Produto::find($id);
    $categorias = Categoria::orderBy('descricao')->get();
    return view('frmProduto', compact('produto', 'categorias'));
  }

  function excluir($id) {
    $produto = Produto::find($id);
    if ($produto->imagem != "") {
      Storage::delete("public/imagens/".$produto->imagem);
    }
    $produto->delete();
    return redirect('produto/listar');
  }

  function mensagem($id) {
    $produto = Produto::find($id) ;
    return view('frmMensagem', compact('produto'));

  }

  function enviarMensagem(Request $request) {
    $id = $request->input('id');
    $mensagem = $request->input('mensagem');
    $produto = Produto::find($id) ;
    Mail::to($produto->email)->send(new ProdutoMensagem($produto, $mensagem));
    return redirect('produto/listar');
  }


}
