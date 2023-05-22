<?php

namespace App\Interfaces;

use App\Models\BaseModel;

interface BaseRepositoryInterface
{
    public function create($data);

    public function insert(array $data);

    public function find($id);

    public function getAll();

    public function update(BaseModel $model, $data);

    public function delete(BaseModel $model);

    public function where($column_name, $value);

    public function paginate($perPage = 15, $columns = ['*']);
}
