<?php

namespace App\Repositories\Rules;

use App\Models\DespesaRecorrente;
use App\Models\User;
use App\Models\Arquivo as ArquivoModel;
use Illuminate\Support\Facades\Storage;

class Arquivo
{
    public static function create(DespesaRecorrente|User $despesa, array $data, string $tipo):void
    {
        $params = ["id_despesa_recorrente" => $despesa->id, "tipo_documento" => $tipo];
        $deleteFile = $despesa->arquivos->where("id_despesa_recorrente", $despesa->id)->where("tipo_documento", $tipo)->first();

        $file = $despesa->arquivos()->updateOrCreate($params, [
            'tipo' => $data[$tipo]->getMimeType(),
            'nome_original' => $data[$tipo]->getClientOriginalName(),
            'extensao' => $data[$tipo]->getClientOriginalExtension(),
            'tamanho' => $data[$tipo]->getSize(),
            'tipo_documento' => $tipo,
        ]);


        Storage::disk('local')->delete('arquivos/'.$deleteFile->id.'.'.$deleteFile->extensao);
        $arquivo = $data[$tipo]->storeAs('arquivos', $file->id.'.'.$data[$tipo]->getClientOriginalExtension());

        $despesa->$tipo = $file->id.'.'.$data[$tipo]->getClientOriginalExtension();
        $despesa->save();
    }
}
