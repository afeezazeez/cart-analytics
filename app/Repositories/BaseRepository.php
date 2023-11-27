<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Create new record for specified model
     */
    public function create(array $data)
    {
        return $this->model->create($data);
    }

    /**
     * Fetch a record by uuid for specified model
     */
    public function getByUUid(string $uuid)
    {
        return $this->model->where('uuid', $uuid)->firstorfail();
    }


    /**
     * Update a record  for specified model
     */
    public function update(array $data, string $uuid): void
    {
        $this->model->where('uuid', $uuid)->update($data);
    }

    /**
     * Delete a record  for specified model
     */
    public function delete(string $uuid): void
    {
        $this->model->where('uuid', $uuid)->delete();
    }


}
