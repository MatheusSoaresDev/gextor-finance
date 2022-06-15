<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory, HasPrimaryKeyUuid, Authenticatable;

    public $timestamps = true;
    protected $fillable = ['nome', 'data', 'valor', 'status', 'boleto', 'documento', 'id_user'];
    protected $table = 'receita';
    protected $visible = ['nome', 'data', 'valor', 'status', 'boleto', 'documento', 'id_user'];
    protected $casts = ['valor' => 'float'];

    public function arquivos()
    {
        return $this->hasMany(ArquivoDespesaRecorrente::class, 'id_despesa_recorrente');
    }
}
