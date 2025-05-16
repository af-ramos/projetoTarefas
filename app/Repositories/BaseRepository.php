<?php

namespace App\Repositories;

abstract class BaseRepository
{
    protected $model;

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function list() {
        return $this->model->get();
    }

    public function show(int $id) {
        return $this->model->find($id);
    }
}
