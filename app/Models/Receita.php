<?php

namespace App\Models;

use App\Models\Arquivos\ArquivoReceita;
use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory, HasPrimaryKeyUuid, Authenticatable;

    public $timestamps = true;
    protected $fillable = ['nome', 'data', 'valor', 'status', 'comentario', 'id_user'];
    protected $table = 'receita';
    protected $visible = ['id','nome', 'data', 'valor', 'status', 'comentario', 'id_user'];

    public function arquivos()
    {
        return $this->hasMany(ArquivoReceita::class, 'id_receita');
    }
}
