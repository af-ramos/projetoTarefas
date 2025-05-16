<?php

namespace App\Interfaces;

interface ProjectRepositoryInterface
{
    public function create(array $data);
    public function list();
    public function show(int $id);
}
