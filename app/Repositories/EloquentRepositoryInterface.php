<?php

namespace App\Repositories;

interface EloquentRepositoryInterface
{
    public function create(array $attributes);

    public function update(array $attributes, $id);

    public function delete($id);

    public function findById($id);

    public function findByUuid($id);

    public function all();

    public function setPagination(array $input);

    public function getPerPage();

    public function getPage();
}
