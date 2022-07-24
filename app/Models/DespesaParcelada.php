<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DespesaParcelada extends Model
{
    use HasFactory, HasPrimaryKeyUuid, Authenticatable;

    public $timestamps = true;
    protected $fillable = ['nome', 'data', 'valor_total', 'forma_pagamento', 'status', 'qtd_parcelas', 'comentario', 'id_user'];
    protected $table = 'despesa_parcelada';
    protected $visible = ['id', 'nome', 'data', 'valor_total', 'forma_pagamento', 'status', 'qtd_parcelas', 'comentario', 'id_user'];

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }
}
