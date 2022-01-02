<?php

namespace App\Repositories\Eloquent;

use App\Exceptions\EntityNotFoundException;
use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function create($input)
    {
        $input['user_id'] = Auth::id();
        return $this->model->create($input);
    }

    public function postsOfFollowing($input)
    {
        $auth_user = Auth::user();
        $following = $auth_user->following()->get()->pluck('id')->toArray();
        $this->setPagination($input);
        $posts = Post::with('user')->whereIn('user_id', $following)->latest()->paginate($this->perpage);
        return  $posts;
    }



    public function delete($id)
    {
        $auth_user = Auth::user();

        $entity = $this->model->where('uuid', $id)->where('user_id', $auth_user->id)->first();

        if (!$entity) {
            throw new EntityNotFoundException();
        }

        $entity->delete();
        return true;
    }
}
