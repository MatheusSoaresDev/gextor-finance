<?php

namespace App\Repositories\Contracts;

Interface MesDespesaRecorrenteRepositoryInterface
{
    public function create(array $data);
    public function get(string $id);
    public function update(array $data);
    public function delete(string $data);
}
