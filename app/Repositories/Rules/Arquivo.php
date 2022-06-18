<?php

namespace App\Repositories\Rules;

use App\Models\DespesaRecorrente;
use App\Models\Receita;
use App\Models\User;
use App\Models\ArquivoDespesaRecorrente as ArquivoModel;
use Illuminate\Support\Facades\Storage;

class Arquivo
{
    public static function create(Receita|DespesaRecorrente $obj, array $data, string $tipo):void
    {
        $params = ["id_despesa_recorrente" => $obj->id, "tipo_documento" => $tipo];

        $file = $obj->arquivos()->updateOrCreate($params, [
            'tipo' => $data[$tipo]->getMimeType(),
            'nome_original' => $data[$tipo]->getClientOriginalName(),
            'extensao' => $data[$tipo]->getClientOriginalExtension(),
            'tamanho' => $data[$tipo]->getSize(),
            'tipo_documento' => $tipo,
        ]);

        self::deleteFile($obj, $tipo);
        self::storeFileAndSave($data, $tipo, $file, $obj);
    }

    private static function deleteFile($despesa, string $tipo):void
    {
        $deleteFile = $despesa->arquivos->where("id_despesa_recorrente", $despesa->id)->where("tipo_documento", $tipo)->first();
        if($deleteFile) {
            Storage::disk('local')->delete('arquivos/' . $deleteFile->id . '.' . $deleteFile->extensao);
        }
    }

    private static function storeFileAndSave(array $data, string $tipo, $file, $despesa):void
    {
        $arquivo = $data[$tipo]->storeAs('arquivos', $file->id.'.'.$data[$tipo]->getClientOriginalExtension());
        /*$despesa->$tipo = $file->id;
        $despesa->save();*/
    }
}
