<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\FuncaoController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\StoreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/pedido/listar', [PedidoController::class, 'listar']);
    Route::get('/pedido/novo', [PedidoController::class, 'novo']);
    Route::get('/pedido/editar/{id}', [PedidoController::class, 'editar']);
    Route::get('/pedido/excluir/{id}', [PedidoController::class, 'excluir']);
    Route::post('/pedido/salvar', [PedidoController::class, 'salvar']);
    Route::get('/pedido/relatorio', [PedidoController::class, 'relatorio']);

    Route::get('/categoria/listar', [CategoriaController::class, 'listar']);
    Route::get('/categoria/novo', [CategoriaController::class, 'novo']);
    Route::get('/categoria/editar/{id}', [CategoriaController::class, 'editar']);
    Route::get('/categoria/excluir/{id}', [CategoriaController::class, 'excluir']);
    Route::post('/categoria/salvar', [CategoriaController::class, 'salvar']);

    Route::get('/funcao/listar', [FuncaoController::class, 'listar']);
    Route::get('/funcao/novo', [FuncaoController::class, 'novo']);
    Route::get('/funcao/editar/{id}', [FuncaoController::class, 'editar']);
    Route::get('/funcao/excluir/{id}', [FuncaoController::class, 'excluir']);
    Route::post('/funcao/salvar', [FuncaoController::class, 'salvar']);

    Route::get('/funcionario/listar', [FuncionarioController::class, 'listar']);
    Route::get('/funcionario/novo', [FuncionarioController::class, 'novo']);
    Route::get('/funcionario/editar/{id}', [FuncionarioController::class, 'editar']);
    Route::get('/funcionario/excluir/{id}', [FuncionarioController::class, 'excluir']);
    Route::post('/funcionario/salvar', [FuncionarioController::class, 'salvar']);

    Route::get('/produto/listar', [ProdutoController::class, 'listar']);
    Route::get('/produto/novo', [ProdutoController::class, 'novo']);
    Route::get('/produto/editar/{id}', [ProdutoController::class, 'editar']);
    Route::get('/produto/excluir/{id}', [ProdutoController::class, 'excluir']);
    Route::post('/produto/salvar', [ProdutoController::class, 'salvar']);



    Route::get('/', function () {
        return view('index');
    });
});

Route::get('/store', [StoreController::class, 'index']);
Route::get('/store/produto/{id}', [StoreController::class, 'produto']);
Route::get('/store/categoria/{id}', [StoreController::class, 'categoria']);
Route::get('/store/funcao/{id}', [StoreController::class, 'funcao']);

require __DIR__.'/auth.php';
