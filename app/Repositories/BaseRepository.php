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

    public function update(int $id, array $data) {
        $this->model = $this->model->find($id)->fill($data);
        $this->model->save();

        return $this->model;
    }

    public function delete(int $id) {
        return $this->model->find($id)->delete();
    }
}
