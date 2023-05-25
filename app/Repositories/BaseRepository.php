<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BaseRepository implements BaseRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * Create a new instance.
     *
     * @param  Model  $model
     * @return void
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Retrieve all data of repository.
     *
     * @param  array  $columns
     * @return mixed
     */
    public function all($relations = [], $columns = ['*']): mixed
    {
        return $this->model::with($relations)->get($columns);
    }

    /**
     * Retrieve all data of repository, paginated.
     *
     * @param  null  $limit
     * @param  array  $columns
     * @return mixed
     */
    public function paginate($relations = [], $limit = null, $columns = ['*']): mixed
    {
        return $this->model::with($relations)->select($columns)->latest()->paginate($limit);
    }

    /**
     * Save a new entity in repository.
     *
     * @param  array  $data
     * @return mixed
     */
    public function create(array $data): mixed
    {
        return $this->model->create($data);
    }

    /**
     * Return an entity.
     *
     * @param  int  $id
     * @return mixed
     */
    public function first($field, $id)
    {
        return $this->model->where($field,$id)->first();   
    }

    /**
     * Update an entity.
     *
     * @param  Model  $entity
     * @param  array  $data
     * @return bool
     */
    public function update(array $data,$field, $id)
    {
        return $this->first($field,$id)->update($data);
    }

    /**
     * Delete an entity.
     *
     * @param  Model  $entity
     * @return bool|null
     */
    public function delete($field,$id): bool|null
    {
        return $this->first($field,$id)->delete();
    }
    /**
     * Update or create an entity.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return mixed
     */
    public function updateOrCreate(array $attributes, array $values): mixed
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * Get entity.
     *
     * @param  array  $condition
     * @param  bool  $takeOne
     * @return mixed
     */
    public function get(array $condition = [], bool $takeOne = true): mixed
    {
        $result = $this->model->where($condition);

        if ($takeOne) {
            return $result->first();
        }

        return $result->get();
    }
}
