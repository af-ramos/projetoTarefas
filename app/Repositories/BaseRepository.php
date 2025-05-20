<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected Model $model;

    public function create(array $data) {
        return $this->model->create($data);
    }

    public function list(array $with = []) {
        return $this->model->with($with)->get();
    }

    public function show(int $id, array $with = []) {
        return $this->model->with($with)->find($id);
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
