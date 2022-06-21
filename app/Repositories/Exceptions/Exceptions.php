<?php

namespace App\Repositories\Exceptions;

use App\Helpers\ResponseJson;
use App\Repositories\Rules\Arquivo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

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
            DB::beginTransaction();
            $file = Arquivo::create($this->getObj($data["id"]), $data["file"]);
            DB::commit();

            return Response::json($file, 200);

        } catch(\Exception $exception){
            DB::rollBack();
            return Response::json($exception->getMessage(), $exception->getCode());
        }
    }

    public function list(string $id)
    {
        try{
            $files = Arquivo::list($this->getObj($id));
            return Response::json($files, 200);

        } catch(\Exception $exception){
            return Response::json($exception->getMessage(), $exception->getCode());
        }
    }

    private function getObj(string $id)
    {
        return $this->model->where("id", $id)->first();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }
}
