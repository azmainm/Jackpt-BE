<?php

namespace App\Infrastructure\Eloquent;

use App\Infrastructure\Exceptions\RepositoryException;
use App\Infrastructure\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface
{
    protected Model $model;

    public function __construct()
    {
        $this->makeModel();
    }

    abstract public function model();

    /**
     * @param  array  $columns
     * @return mixed
     */
    public function getAll($columns = ['*'])
    {
        return $this->model->get($columns);
    }

    public function uuid($uuid, $relations = null)
    {
        if ($relations) {
            return $this->model->where('uuid', $uuid)->with($relations)->first();
        }

        return $this->model->where('uuid', $uuid)->first();
    }

    public function paginate($perPage = 15)
    {
        return $this->model->paginate($perPage);
    }

    public function first($columns = ['*'])
    {
        return $this->model->first($columns);
    }

    public function show($id)
    {
        return $this->model->find($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id, $attribute = 'id')
    {
        return $this->model->where($attribute, '=', $id)->update($data);
    }

    public function delete($id = null, string $uuid = null)
    {
        if ($uuid) {
            return $this->model->where('uuid', $uuid)->delete();
        }

        return $this->model->destroy($id);
    }

    public function find($id, $with = null, $columns = ['*'])
    {
        if ($with == null) {
            return $this->model->find($id, $columns);
        }

        return $this->model->with($with)->find($id, $columns);
    }

    public function findBy($column, $value, $method = 'get')
    {
        return $this->model->where($column, $value)->{$method}();
    }

    public function findOrFail($id, $with = null, $columns = ['*'])
    {
        if ($with == null) {
            return $this->model->findOrFail($id, $columns);
        }

        return $this->model->with($with)->findOrFail($id, $columns);
    }

    public function makeModel()
    {
        return $this->setModel($this->model());
    }

    public function setModel($eloquentModel)
    {
        $model = app()->make($eloquentModel);

        if (! $model instanceof Model) {
            throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Models");
        }

        return $this->model = $model;
    }
}
