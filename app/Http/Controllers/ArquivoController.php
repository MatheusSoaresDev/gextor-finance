<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArquivoController extends Controller
{
    public function insertFile(Request $request)
    {
        dd($request->all());
    }
}
