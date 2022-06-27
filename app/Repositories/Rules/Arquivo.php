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

    public static function get(Receita|DespesaRecorrente $obj)
    {
        $files = $obj->arquivos()->get();
        if($files->count() < 1){
            throw new \Exception("Não há arquivos anexados para este objeto.", 404);
        }
        return $files;
    }

    public static function update(Receita|DespesaRecorrente $obj, array $data)
    {
        $file = $obj->arquivos()->find($data["id_file"]);
        $file->tipo_documento = $data["tipo"];
        $file->save();
        return $file;
    }

    public static function delete(Receita|DespesaRecorrente $obj, array $data):void
    {
        $file = $obj->arquivos()->find($data["id_file"]);
        if($file->delete()){
            Storage::delete($file->id . '.' . $file->extensao);
        }
    }

    private static function storeFileAndSave(UploadedFile $arq, $file)
    {
        $arquivo = $arq->storeAs('', $file->id.'.'.$arq->getClientOriginalExtension());
    }
}
