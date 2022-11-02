<?php

namespace App\Interfaces;

use App\Models\BaseModel;

interface BaseRepositoryInterface
{
    public function create($data);

    public function firstOrCreate($data);

    public function insert(array $data);

    public function insertOrIgnore(array $data);

    public function find($id);

    public function findOrFail($id);

    public function getAll();

    public function update(BaseModel $model, $data);

    public function delete(BaseModel $model);

    public function where($column_name, $value);

    public function whereIn($column_name, $value);

    public function builder();

    public function paginate($perPage = 15, $columns = ['*']);
}
