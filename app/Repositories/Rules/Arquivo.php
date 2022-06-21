<?php

namespace App\Repositories\Rules;

use App\Models\DespesaRecorrente;
use App\Models\Receita;
use App\Models\User;
use App\Models\ArquivoDespesaRecorrente as ArquivoModel;
use App\Repositories\Transformers\Arquivo\TransformArquivo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Arquivo
{
    public static function create(Receita|DespesaRecorrente $obj, $arq, string $tipo)
    {
        $file = $obj->arquivos()->create([
            'tipo' => $arq->getMimeType(),
            'nome_original' => $arq->getClientOriginalName(),
            'extensao' => $arq->getClientOriginalExtension(),
            'tamanho' => $arq->getSize(),
            'tipo_documento' => $tipo,
        ]);

        self::storeFileAndSave($arq, $file);
        return $file;
    }

    private function deleteFile($despesa, string $tipo):void
    {
        $deleteFile = $despesa->arquivos->where("id_despesa_recorrente", $despesa->id)->where("tipo_documento", $tipo)->first();
        if($deleteFile) {
            Storage::disk('local')->delete('Arquivos/' . $deleteFile->id . '.' . $deleteFile->extensao);
        }
    }

    private static function storeFileAndSave(UploadedFile $arq, $file)
    {
        $arquivo = $arq->storeAs('', $file->id.'.'.$arq->getClientOriginalExtension());
    }
}
