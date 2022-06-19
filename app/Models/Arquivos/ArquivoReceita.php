<?php

namespace App\Models\Arquivos;

use App\Models\Receita;
use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArquivoReceita extends Model
{
    use HasFactory, HasPrimaryKeyUuid, Authenticatable;

    public $timestamps = true;
    protected $fillable = ['id', 'tipo', 'nome_original', 'extensao', 'tamanho', 'tipo_documento', 'id_receita'];
    protected $table = 'arquivo_receita';
    protected $visible = ['id', 'tipo', 'nome_original', 'extensao', 'tamanho', 'tipo_documento', 'id_receita'];

    public function receita()
    {
        return $this->belongsTo(Receita::class);
    }
}
