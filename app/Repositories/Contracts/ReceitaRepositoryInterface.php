<?php

namespace App\Repositories\Contracts;

interface ReceitaRepositoryInterface
{
    public function create(array $data);
    public function get(string $id);
    public function update(array $data);
    public function delete(string $data);
}