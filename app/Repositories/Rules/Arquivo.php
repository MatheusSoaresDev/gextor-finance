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
    public static function create(Receita|DespesaRecorrente $obj, $arq)
    {
        $file = $obj->arquivos()->create([
            'tipo' => $arq->getMimeType(),
            'nome_original' => $arq->getClientOriginalName(),
            'extensao' => $arq->getClientOriginalExtension(),
            'tamanho' => $arq->getSize(),
            'tipo_documento' => null,
        ]);

        self::storeFileAndSave($arq, $file);
        return $file;
    }

    public static function list(Receita|DespesaRecorrente $obj)
    {
        return $obj->arquivos()->get();
    }

    public static function alteraTipo(Receita|DespesaRecorrente $obj, array $data)
    {
        $file = $obj->arquivos()->find($data["id_file"]);
        $file->tipo_documento = $data["tipo"];
        $file->save();
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
