<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\EntityNotFoundException;
use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    protected $model;
    protected $perpage = 10;
    protected $currentPage = 1;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        if (isset($attributes['_token'])) {
            unset($attributes['_token']);
        }
        return $this->model->create($attributes);
    }

    public function update(array $attributes, $id)
    {
        if (isset($attributes['_token'])) {
            unset($attributes['_token']);
        }
        if (isset($attributes['_method'])) {
            unset($attributes['_method']);
        }
        $entity =  $this->findById($id);
        $entity->update($attributes);
        return $entity;
    }

    public function findById($id)
    {
        $entity = $this->model->find($id);

        if (!$entity) {
            throw new EntityNotFoundException();
        }

        return $entity;
    }

    public function findByUuid($id)
    {

        $entity = $this->model->where('uuid', $id)->first();


        if (!$entity) {
            throw new EntityNotFoundException();
        }

        return $entity;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function setPagination($input)
    {
        if (isset($input['perpage'])) {
            if ($input['perpage'] > 100) {
                $this->perpage = 100;
            } else {
                $this->perpage = $input['perpage'];
            }
        }

        if (isset($input['page'])) {
            $this->currentPage = $input['page'];
        }
    }

    public function getPerPage()
    {
        return $this->perpage;
    }

    public function getPage()
    {
        return $this->currentPage;
    }

    public function delete($id)
    {
        $entity =  $this->findById($id);
        $entity->delete();
        return true;
    }
}
