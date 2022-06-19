<?php

namespace App\Repositories\Exceptions;

use App\Repositories\Rules\Arquivo;

class Exceptions
{
    protected $model;
    protected string $tipo;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function create(array $data)
    {
        try{
            $obj = $this->model->where("id", $data["id"])->first();
            $file = Arquivo::create($obj, $data["file"], $this->tipo);

        } catch(\Exception $exception){

        }
    }

    protected function resolveModel()
    {
        return app($this->model);
    }
}
