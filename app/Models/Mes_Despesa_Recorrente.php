<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mes_Despesa_Recorrente extends Model
{
    use HasFactory, HasPrimaryKeyUuid, Authenticatable;

    public $timestamps = true;
    protected $fillable = ['id', 'data', 'valor', 'comentario', 'forma_pagamento', 'status', 'boleto', 'comprovante', 'id_user', 'id_depesa_recorrente'];
    protected $table = 'mes_despesa_recorrente';
    protected $visible = ['id', 'data', 'valor', 'comentario', 'forma_pagamento', 'status', 'boleto', 'comprovante', 'id_user', 'despesa_recorrente'];

    public function user()
    {
        return $this->hasMany(User::class);
    }

    public function despesa_recorrente()
    {
        return $this->hasOne(DespesaRecorrente::class);
    }
}
