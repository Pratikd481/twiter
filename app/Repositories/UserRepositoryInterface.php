<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function following();

    public function profileDataByUserId($id);

    public function myProfileData();

    public function myPosts(array $input);

    public function postByUser(array $input, $id);
}
