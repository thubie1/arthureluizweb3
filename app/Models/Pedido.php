<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Produto;
use App\Models\PedidoProduto;
use App\Models\Funcionario;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pedido extends Model
{
    use HasFactory;
    protected $table = 'pedido';
    public $timestamps = false;
    protected $casts = [
        'data' => 'datetime:Y-m-d',
    ];
    public function produtos(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class, 'pedido_produto',  'id_pedido', 'id_produto');
    }
    public function funcionario(): BelongsTo
    {
       return $this->belongsTo(Funcionario::class);
    }
}
