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

    /**
     * Create post.
     *
     * @param array input from request
     * @return post
     */
    public function create($input)
    {
        $input['user_id'] = Auth::id();
        return $this->model->create($input);
    }

    /**
     * All posts by following user.
     *
     * @param array input from request
     * @return list of posts
     */
    public function postsOfFollowing($input)
    {
        $auth_user = Auth::user();
        $following = $auth_user->following()->get()->pluck('id')->toArray();
        $this->setPagination($input);
        $posts = Post::with('user')->whereIn('user_id', $following)->latest()->paginate($this->perpage);
        return  $posts;
    }


    /**
     * Delete post.
     *
     * @param int post id
     * @return list of posts
     */
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
