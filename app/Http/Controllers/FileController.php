<?php

namespace App\Http\Controllers;

use App\Models\Arquivo;
use Illuminate\Http\Request;

class FileController extends Controller
{
     public function open(string $idArquivo)
    {
        $file = Arquivo::where('id', $idArquivo)->first();
        $path = storage_path("app/arquivos/$file->id".'.'.$file->extensao);

        return response()->file($path, [
            'Content-Type' => $file->tipo,
            'Cache-Control' => 'no-cache',
            'Pragma' => 'no-cache',
            'Content-Disposition', 'inline;filename=myfile.pdf',
        ]);
    }
}
