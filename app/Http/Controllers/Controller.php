<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected static function redirect($response, string $action, string $redirectPage)
    {
        if($response){
            return redirect($redirectPage)->withSuccess("Despesa {$action} com sucesso!");
        }
        return redirect($redirectPage)->withErrors("Não foi {$action} a despesa!");
    }
}
