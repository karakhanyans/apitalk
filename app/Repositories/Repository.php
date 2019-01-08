<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class Repository
{
    public $model;

    public function __construct($model)
    {
        /** @var \Eloquent $model */
        $this->model = $model;
    }

    /**
     * Get record by id
     *
     * @param $id
     * @return \Eloquent|\Eloquent[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    /**
     * Get records
     *
     * @param int $limit
     * @return \Eloquent|\Eloquent[]|\Illuminate\Contracts\Pagination\LengthAwarePaginator|\Illuminate\Database\Eloquent\Collection
     */
    public function all($limit = 0)
    {
        $model = $this->model->orderBy('id', 'desc');
        $model = $limit ? $model->paginate($limit) : $model->get();
        return $model;
    }

    /**
     * Create new record
     *
     * @param $data
     * @return \Eloquent
     */
    public function create($data)
    {
        $this->model = $this->model->fill($data);
        $this->model->save();
        return $this->model;
    }

    /**
     * Edit record by record instance
     *
     * @param Model $model
     * @param $data
     * @return Model
     */
    public function edit(Model $model, $data)
    {
        $model->fill($data);
        $model->save();
        return $model;
    }

    /**
     * Delete record by model instance
     *
     * @param Model $model
     * @return bool|null
     */
    public function delete(Model $model)
    {
        try {
            $deleted = $model->delete();
        } catch (\Exception $e) {
            $deleted = false;
        }
        return $deleted;
    }
}
