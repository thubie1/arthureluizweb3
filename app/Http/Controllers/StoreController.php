<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Produto;


class StoreController extends Controller
{
    function index() {
      $categorias = Categoria::orderBy('descricao')->get();

      $ultimosProdutos = Produto::orderBy('data', 'nome')->limit(5)->get();

      return view('news', compact('categorias', 'ultimasProdutos'));
    }

    function produto($id) {
      $produtoAtual = Produto::find($id);
      $categorias = Categoria::orderBy('descricao')->get();
      $produtosCategoria = Produto::where('categoria_id',
        $produtoAtual->categoria->id)->orderBy('nome')->paginate(5);
      return view('produto', compact('produtoAtual', 'categorias', 'produtosCategoria'));
    }

    function categoria($id) {
      $categorias = Categoria::orderBy('descricao')->get();
      $produtosCategoria = Produto::where('categoria_id',
        $id)->orderBy('nome')->paginate(5);
      $produtoAtual = $produtosCategoria
      ->shift();
      return view('produto', compact('produtoAtual', 'categorias', 'produtosCategoria'));
    }
}
