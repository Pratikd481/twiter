<?php

namespace App\Repositories;

interface PostRepositoryInterface
{
    public function postsOfFollowing($input);
}
