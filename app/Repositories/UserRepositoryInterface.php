<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    /**
     * Some of the following users.
     *
     * @return list of user
     */
    public function following();

    /**
     * list of following users with pagination.
     *
     * @return list of user
     */
    public function followingList();

    /**
     * list of followers with pagination.
     *
     * @return list of user
     */
    public function followerList();

    /**
     * Follow or Unfollow users
     *
     * @return true
     */
    public function follow(int $id);

    /**
     * Profile data by user id
     *
     * @return user data
     */
    public function profileDataByUserId($id);

    /**
     * Auth user data
     *
     * @return user data
     */
    public function myProfileData();

    /**
     * List of posts by auth user
     *
     * @return list of post
     */
    public function myPosts(array $input);

    /**
     * List of posts by other users
     *
     * @return list of post
     */
    public function postByUser(array $input, $id);

     /**
     * List of profiles
     *
     * @return list of users
     */
    public function profiles(array $input);
}
