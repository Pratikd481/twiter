<?php

namespace App\Http\Controllers\FrontEnd;

use App\Exceptions\EntityNotFoundException;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{

    private $postRepository;
    private $userRepository;

    public function __construct(PostRepositoryInterface $postRepository, UserRepositoryInterface $userRepository)
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }

    public function profile(Request $request, $id)
    {
        try {
            $user =  $this->userRepository->findByUuid($id);
            $profile_data = $this->userRepository->profileDataByUserId($user->id);
            $posts = $this->userRepository->postByUser($request->all(), $profile_data->id);
        } catch (EntityNotFoundException $e) {
            return view('entity-not-found');
        } catch (Exception $e) {
            Log::error("Error while fething postsr: " . json_encode($e));
            return redirect(route('user.technicalIssue'));
        }

        return view('profile', ['posts' => $posts, 'profile_data' => $profile_data]);
    }

    public function myProfile(Request $request)
    {
        try {
            $posts = $this->userRepository->myPosts($request->all());
            $profile_data = $this->userRepository->myProfileData();
            $perPage = $this->userRepository->getPerPage();
        } catch (Exception $e) {

            Log::error("Error while fething postsr: " . json_encode($e));
            return redirect(route('user.technicalIssue'));
        }
        return view('profile', ['posts' => $posts, 'profile_data' => $profile_data]);
    }


    public function profiles(Request $request)
    {

        try {
            $users = $this->userRepository->profiles($request->all());
            $perPage = $this->userRepository->getPerPage();
        } catch (Exception $e) {
            Log::error("Error while fething postsr: " . json_encode($e));
            return redirect(route('user.technicalIssue'));
        }
        return view('explore', ['explore_users' => $users]);
    }

    public function folowing(Request $request)
    {
        try {
            $users = $this->userRepository->followingList($request->all());
            $perPage = $this->userRepository->getPerPage();
        } catch (Exception $e) {
            Log::error("Error while fething postsr: " . json_encode($e));
            return redirect(route('user.technicalIssue'));
        }

        return view('explore', ['explore_users' => $users]);
    }

    public function followers(Request $request)
    {
        try {
            $users = $this->userRepository->followerList($request->all());
            $perPage = $this->userRepository->getPerPage();
        } catch (Exception $e) {
            Log::error("Error while fething postsr: " . json_encode($e));
            return redirect(route('user.technicalIssue'));
        }
        return view('explore', ['explore_users' => $users]);
    }

    public function follow($id)
    {
        try {
            $user =  $this->userRepository->findByUuid($id);
            $this->userRepository->follow($user->id);
        } catch (EntityNotFoundException $e) {

            Log::error("Post update error: " . json_encode($e));
            return response()->json([
                'errors' => __('Not updated. Something went wrong.')
            ], 400);
        } catch (Exception $e) {

            Log::error("Post update error: " . json_encode($e));
            return response()->json([
                'errors' => __('Not updated. Something went wrong.')
            ], 400);
        }
        Session::flash('follow-message', 'Updated successfully.');

        return response()->json([
            'data' =>  $user->toArray(),
            'redirect_route' => route('my.profile')
        ], 201);
    }

    public function technicalIssue()
    {
        return view('technical-issue');
    }
}
