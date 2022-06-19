<?php

namespace App\Repositories\Exceptions;

use App\Models\Arquivos\ArquivoReceita;
use App\Models\Receita;
use App\Repositories\Contracts\Arquivos\ReceitaArquivoRepositoryInterface;
use App\Repositories\Rules\Arquivo;

class ArquivoReceitaExceptions extends Exceptions
{
    protected $model = Receita::class;
    protected string $tipo = 'receita';

    /*private ReceitaArquivoRepositoryInterface $receitaArquivoRepository;

    public function __construct(ReceitaArquivoRepositoryInterface $receitaArquivoRepository)
    {
        $this->receitaArquivoRepository = $receitaArquivoRepository;
    }*/


    /*protected $model = ArquivoReceita::class;

    public function create(array $data)
    {
        try{
            $obj = $this->model->where("id", $data["id"])->first();
            dd($obj);

            $file = new Arquivo($obj);
            $createdFile = $file->create($data["file"], $this->tipo);

        } catch(\Exception $exception){

        }
    }*/
}
