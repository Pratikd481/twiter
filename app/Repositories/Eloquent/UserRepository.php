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
        return $auth_user->following()->orderBy('networks.id', 'DESC')->limit(10)->get();
    }

    public function follow($id)
    {
        $auth_user = Auth::user();
        $user = User::find($id);
        if (!$user) {
            throw new EntityNotFoundException();
        }
        if (!$auth_user->isFollowing($user)) {
            $auth_user->following()->attach($user->id);
        } else {
            $auth_user->following()->detach($user->id);
        }
        return true;
    }

    public function profiles($input = [])
    {
        $auth_user = Auth::user();
        $this->setPagination($input);
        $users =  User::where('id', '!=', $auth_user->id)->paginate($this->perpage);
        $friends = $auth_user->following()->pluck('users.id')->toArray();
        $users->map(function ($item) use ($friends) {
            if (!in_array($item->id, $friends)) {
                $item->isFollowing = 'NO';
            } else {
                $item->isFollowing = 'YES';
            }
        });
        return $users;
    }

    public function followingList($input = [])
    {
        $this->setPagination($input);
        $auth_user = Auth::user();
        $following = $this->model->find($auth_user->id)->following()->paginate($this->perpage);
        $following->map(function ($item) {
            $item->isFollowing = 'YES';
        });
        return $following;
    }

    public function followerList($input = [])
    {
        $this->setPagination($input);
        $auth_user = Auth::user();
        $follower =  $this->model->find($auth_user->id)->followedBy()->paginate($this->perpage);
        $friends = $auth_user->following()->pluck('users.id')->toArray();
        $follower->map(function ($item) use ($friends) {
            if (!in_array($item->id, $friends)) {
                $item->isFollowing = 'NO';
            } else {
                $item->isFollowing = 'YES';
            }
        });
        return $follower;
    }

    public function profileDataByUserId($id)
    {
        $auth_user = Auth::user();
        $entity = $this->model->with(['following', 'followedBy', 'posts'])->where('id', $id)->first();
        if (!$entity) {
            throw new EntityNotFoundException();
        }
        $friends = $auth_user->following()->pluck('users.id')->toArray();
        if (!in_array($entity->id, $friends)) {
            $entity->isFollowing = 'NO';
        } else {
            $entity->isFollowing = 'YES';
        }
        return $entity;
    }

    public function myProfileData()
    {
        $auth_user = Auth::user();
        $entity = $this->model->with(['following', 'followedBy', 'posts'])->where('id', $auth_user->id)->first();
        return $entity;
    }
}
