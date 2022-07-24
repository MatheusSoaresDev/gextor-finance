<?php

namespace App\Models;

use App\Models\Arquivos\ArquivoDespesaRecorrente;
use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @method static where(string $string, string $string1)
 */
class DespesaRecorrente extends Model
{
    use HasFactory, HasPrimaryKeyUuid, Authenticatable;

    public $timestamps = true;
    protected $fillable = ['nome', 'nome', 'data', 'valor', 'forma_pagamento', 'status', 'comentario', 'id_user'];
    protected $table = 'despesa_recorrente';
    protected $visible = ['id', 'nome', 'data', 'valor', 'forma_pagamento', 'status', 'comentario', 'id_user'];

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    public function arquivos()
    {
        return $this->hasMany(ArquivoDespesaRecorrente::class, 'id_despesa_recorrente');
    }
}
