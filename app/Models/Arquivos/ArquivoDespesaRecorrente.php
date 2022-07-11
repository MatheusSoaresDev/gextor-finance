<?php

namespace App\Models\Arquivos;

use App\Models\DespesaRecorrente;
use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoDespesaRecorrente extends Model
{
    use HasFactory, HasPrimaryKeyUuid, Authenticatable;

    public $timestamps = true;
    protected $fillable = ['id', 'tipo', 'nome_original', 'extensao', 'tamanho', 'tipo_documento', 'id_despesa_recorrente'];
    protected $table = 'arquivo_despesa_recorrente';
    protected $visible = ['id', 'tipo', 'nome_original', 'extensao', 'tamanho', 'tipo_documento', 'id_despesa_recorrente'];

    public function despesaRecorrente()
    {
        return $this->belongsTo(DespesaRecorrente::class);
    }
}
