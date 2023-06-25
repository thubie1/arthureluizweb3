<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Funcao extends Model
{
    use HasFactory;
    protected $table = 'funcao';
    public $timestamps = false;
    public function funcionario(): HasMany
    {
        return $this->hasMany(Funcionario::class)->orderByRaw('data desc')->take(3);
    }
}
