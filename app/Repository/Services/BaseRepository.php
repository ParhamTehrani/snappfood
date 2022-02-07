<?php


namespace App\Repository\Services;


use App\Repository\Interfaces\BaseRepositoryInterface;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function all(array $columns = ['*'], array $relations = [])
    {
        return $this->model->with($relations)->withCount($relations)->get($columns);
    }

    public function findById(int $modelId, array $columns = ['*'], array $relations = [])
    {
        return $this->model->select($columns)->with($relations)->findOrFail($modelId);
    }

    public function create(array $payload)
    {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    public function update(int $modelId, array $payload): bool
    {
        $model = $this->findById($modelId);
        return $model->update($payload);
    }

    public function deleteById(int $modelId): bool
    {
        return $this->findById($modelId)->delete();
    }

    public function take(int $number, array $columns = ['*'], array $relations = [])
    {
        return $this->model->with($relations)->withCount($relations)->select($columns)->take($number)->get();
    }
}
