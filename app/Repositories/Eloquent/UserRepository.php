<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\EntityNotFoundException;
use App\Models\Post;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{


    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function create($input)
    {
        $input['user_id'] = Auth::id();
        return $this->model->create($input);
    }

    public function myPosts($input)
    {
        $auth_user = Auth::user();
        $this->setPagination($input);
        $posts = Post::with('user')->where('user_id', $auth_user->id)->latest()->paginate($this->perpage);
        return  $posts;
    }

    public function postByUser($input, $id)
    {
        $this->setPagination($input);
        $posts = Post::with('user')->where('user_id', $id)->latest()->paginate($this->perpage);


        return  $posts;
    }

    public function following()
    {
        $auth_user = Auth::user();
        return $auth_user->following()->get();
    }

    public function profileDataByUserId($id)
    {
        if (is_int($id)) {
            $entity = $this->model->with(['following', 'followedBy', 'posts'])->where('id', $id)->first();
        }
        if (is_string($id)) {
            $entity = $this->model->with(['following', 'followedBy', 'posts'])->where('uuid', $id)->first();
        }

        if (!$entity) {
            throw new EntityNotFoundException();
        }
        return $entity;
    }

    public function myProfileData()
    {
        $auth_user = AUth::user();
        $entity = $this->model->with(['following', 'followedBy', 'posts'])->where('id', $auth_user->id)->first();
        return $entity;
    }
}
