<?php

namespace App\Repositories;

interface PostRepositoryInterface
{

    /**
     * All posts by following user.
     *
     * @param array input from request
     * @return list of posts
     */
    public function postsOfFollowing(array $input);
}
