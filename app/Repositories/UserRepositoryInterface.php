<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function following();

    public function followingList();

    public function followerList();

    public function follow(int $id);

    public function profileDataByUserId($id);

    public function myProfileData();

    public function myPosts(array $input);

    public function postByUser(array $input, $id);

    public function profiles(array $input);
}
