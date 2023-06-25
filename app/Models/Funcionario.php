<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Funcao;

class Funcionario extends Model
{
    use HasFactory;
    protected $table = 'funcionario';
    public $timestamps = false;
    public function funcao(): BelongsTo
    {
       return $this->belongsTo(Funcao::class);
    }
}
