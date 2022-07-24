<?php

namespace App\Traits;

use Illuminate\Support\Facades\Request;

trait GetMes
{
    public function getMes()
    {
        return $this->all()
            ->whereMonth('data', Request::session()->get('data')['mes'])
            ->whereYear('data', Request::session()->get('data')['ano'])
            ->get();
    }
}
