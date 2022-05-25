<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    use HasFactory, HasPrimaryKeyUuid, Authenticatable;

    public $timestamps = true;
    protected $fillable = ['id', 'tipo', 'nome_original', 'extensao', 'tamanho', 'tipo_documento', 'id_despesa_recorrente'];
    protected $table = 'arquivos';
    protected $visible = ['id', 'tipo', 'nome_original', 'extensao', 'tamanho', 'tipo_documento', 'id_despesa_recorrente'];

    public function despesasRecorrentes()
    {
        return $this->belongsTo(DespesaRecorrente::class);
    }
}
