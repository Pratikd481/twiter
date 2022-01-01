<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Repositories\PostRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postRepository->postsOfFriends();
        return view('posts');
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        try {

            $this->postRepository->create($request->all());
        } catch (\Illuminate\Database\QueryException  $e) {

            //log query exception for now i'm using dd but in production I will
            Log::error("Post creation error: " . $e->getMessage());
            return redirect(route('user.technicalIssue'));
        } catch (Exception $e) {

            Log::error("Post creation error: " . json_encode($e));
            return redirect(route('user.technicalIssue'));
        }

        Session::flash('post-create-message', 'Created successfully.');
        return redirect(route('my.profile'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
