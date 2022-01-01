<?php

namespace App\Repositories;

interface EloquentRepositoryInterface
{
    public function create( array $attributes );

    public function update( array $attributes, int $id );

    public function find( int $id );

    public function all();

}
