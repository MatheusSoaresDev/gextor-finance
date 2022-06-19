<?php

namespace App\Repositories\Exceptions;

use App\Repositories\Rules\Arquivo;
use Illuminate\Support\Facades\DB;

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
            $file = Arquivo::create($this->getObj($data), $data["file"], $this->tipo);
            DB::commit();

            return response()->json($file);

        } catch(\Exception $exception){
            DB::rollBack();
            return response()->json([
                "message" => $exception->getMessage(),
                "code" => $exception->getCode()
            ]);
        }
    }

    private function getObj(array $data)
    {
        return $this->model->where("id", $data["id"])->first();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }
}
