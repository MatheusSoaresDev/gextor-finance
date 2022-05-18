<?php

namespace App\Repositories\Eloquent;

use Illuminate\Support\Facades\Auth;

abstract class AbstractRepository
{
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
        return $this->model->where('id', $data['id'])->update($data);
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
