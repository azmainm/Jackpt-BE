<?php

namespace App\Repository;

use App\Interfaces\BaseRepositoryInterface;
use App\Models\BaseModel;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function firstOrCreate($data)
    {
        return $this->model->firstOrCreate($data);
    }

    public function insert(array $data)
    {
        $insert_data = array_map(function ($value) {
            return $value;
        }, $data);

        return $this->model->insert($insert_data);
    }

    public function insertOrIgnore(array $data)
    {
        return $this->model->insertOrIgnore($data);
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function findOrFail($id)
    {
        return $this->model->findOrFail($id);
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function update(BaseModel $model, $data)
    {
        return $model->update($data);
    }

    public function updateByQuery($query, $data)
    {
        return $query->update($data);
    }

    public function delete(BaseModel $model)
    {
        return $model->delete();
    }

    public function countAll()
    {
        return $this->model->count();
    }

    public function getQuery()
    {
        return $this->model->query();
    }

    public function where($column_name, $value)
    {
        return $this->model->where($column_name, $value);
    }

    public function whereIn($column_name, $value)
    {
        return $this->model->whereIn($column_name, $value);
    }

    public function builder()
    {
        return $this->model->newQuery();
    }

    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }
}
