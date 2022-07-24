<?php

namespace App\Repositories\Exceptions;

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

            return Response::json($file);

        } catch(\Exception $exception){
            DB::rollBack();
            return Response::json(["message" => $exception->getMessage(), "code" => $exception->getCode()], $exception->getCode());
        }
    }

    public function get(string $id)
    {
        try{
            $files = Arquivo::get($this->getObj($id));
            return Response::json($files);

        } catch(\Exception $exception){
            return Response::json(["message" => $exception->getMessage(), "code" => $exception->getCode()], $exception->getCode());
        }
    }

    public function update(array $data)
    {
        try{
            $files = Arquivo::update($this->getObj($data["id_obj"]), $data);
            return Response::json($files);

        } catch(\Exception $exception){
            return Response::json(["message" => $exception->getMessage(), "code" => $exception->getCode()], $exception->getCode());
        }
    }

    public function delete(array $data)
    {
        try{
            DB::beginTransaction();
            $files = Arquivo::delete($this->getObj($data["id_obj"]), $data);
            DB::commit();

            return Response::json($files);

        } catch(\Exception $exception){
            DB::rollBack();
            return Response::json(["message" => $exception->getMessage(), "code" => $exception->getCode()], $exception->getCode());
        }
    }

    public function viewFile(string $idArquivo, $tipoArquivo)
    {
        try {
            return Arquivo::viewFile($idArquivo, $tipoArquivo);

        } catch (\Exception $exception){
            return Response::json(["message" => $exception->getMessage(), "code" => $exception->getCode()], $exception->getCode());
        }
    }

    public function downloadFile(string $idArquivo, $tipoArquivo)
    {
        try {
            return Arquivo::downloadFile($idArquivo, $tipoArquivo);

        } catch (\Exception $exception){
            return Response::json(["message" => $exception->getMessage(), "code" => $exception->getCode()], $exception->getCode());
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
