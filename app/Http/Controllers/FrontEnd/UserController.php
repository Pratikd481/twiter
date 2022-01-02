<?php

namespace App\Http\Controllers\FrontEnd;

use App\Exceptions\EntityNotFoundException;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
            $profile_data = $this->userRepository->profileDataByUserId($id);
            $posts = $this->userRepository->postByUser($request->all(), $profile_data->id);

            $perPage = $this->userRepository->getPerPage();
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

    public function updateProfile()
    {
        return view('update-profile');
    }

    public function profiles()
    {
        return view('explore');
    }

    public function folowing()
    {
        return view('explore');
    }

    public function followers()
    {
        return view('explore');
    }

    public function technicalIssue()
    {
        return view('technical-issue');
    }
}
