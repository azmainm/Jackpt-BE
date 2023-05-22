<?php

namespace App\Infrastructure\Interfaces;

interface RepositoryInterface
{
    public function getAll($columns = ['*']);

    public function paginate($perPage = 15);

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function find($id, $columns = ['*']);

    public function show($id);
}
