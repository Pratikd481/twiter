<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\PostRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public $post;

    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function create($input)
    {
        $input['user_id'] = Auth::id();
        return $this->model->create($input);
    }

    public function postsOfFriends()
    {
    }
}
