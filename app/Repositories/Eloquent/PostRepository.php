<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public $post;

    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function postsOfFriends()
    {
    }
}
