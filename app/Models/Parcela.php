<?php

namespace App\Models;

use App\Traits\HasPrimaryKeyUuid;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory, HasPrimaryKeyUuid, Authenticatable;

    public $timestamps = true;
    protected $fillable = ['parcela', 'data', 'valor', 'comentario', 'id_despesa_parcelada'];
    protected $table = 'parcela';
    protected $visible = ['parcela', 'data', 'valor', 'comentario', 'id_despesa_parcelada'];

    public function despesaParcelada()
    {
        return $this->belongsTo(DespesaParcelada::class);
    }
}
