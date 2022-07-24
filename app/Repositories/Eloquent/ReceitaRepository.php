<?php

namespace App\Repositories\Eloquent;

use App\Models\Receita;
use App\Repositories\Contracts\ReceitaRepositoryInterface;
use Illuminate\Support\Facades\Request;

class ReceitaRepository extends AbstractRepository implements ReceitaRepositoryInterface
{
    protected $model = Receita::class;
}
