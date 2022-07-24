<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Rules\Arquivo;
use Illuminate\Support\Facades\Auth;
use App\Traits\GetMes;

abstract class AbstractRepository
{
    use GetMes;

    protected $model;

    public function __construct()
    {
        $this->model = $this->resolveModel();
    }

    public function all()
    {
        return $this->model->where('id_user', Auth::id());
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function get(string $id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function update(array $data)
    {
        return $this->get($data["id"])->update($data);
    }

    public function delete(string $id)
    {
        return $this->get($id)->delete();
    }

    protected function resolveModel()
    {
        return app($this->model);
    }
}
