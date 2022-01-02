<?php

namespace App\Http\Controllers\FrontEnd;

use App\Exceptions\EntityNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\PostRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    private $postRepository;
    private $userRepository;

    public function __construct(PostRepositoryInterface $postRepository, UserRepositoryInterface $userRepository)
    {
        $this->postRepository = $postRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $posts = $this->postRepository->postsOfFollowing($request->all());
            $perPage = $this->postRepository->getPerPage();
        } catch (Exception $e) {

            Log::error("Error while fething postsr: " . json_encode($e));
            return redirect(route('user.technicalIssue'));
        }

        return view('posts', ['posts' => $posts]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
        try {

            $this->postRepository->create($request->all());
        } catch (Exception $e) {

            Log::error("Post creation error: " . json_encode($e));
            return redirect(route('user.technicalIssue'));
        }

        Session::flash('post-message', 'Created successfully.');
        return redirect(route('my.profile'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostUpdateRequest $request, $id)
    {

        try {
            $post =  $this->postRepository->findByUuid($id);
            $updatedPost = $this->postRepository->update($request->all(), $post->id);
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
        Session::flash('post-message', 'Updated successfully.');

        return response()->json([
            'data' =>  $updatedPost->toArray(),
            'redirect_route' => route('my.profile')
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $post =  $this->postRepository->findByUuid($id);
            $dleted = $this->postRepository->delete($id);
        } catch (EntityNotFoundException $e) {

            Log::error("Post delete error: " . json_encode($e));
            return response()->json([
                'errors' => __('Not deleted. Something went wrong.')
            ], 400);
        } catch (Exception $e) {
            Log::error("Post delete error: " . json_encode($e));
            return response()->json([
                'errors' => __('Not deleted. Something went wrong.')
            ], 400);
        }

        Session::flash('post-message', 'Deleted successfully.');
        return response()->json([
            'data' => [
                'deleted' => $dleted
            ],
            'redirect_route' => route('my.profile')
        ], 200);
    }
}
