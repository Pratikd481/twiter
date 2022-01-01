<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function myProfile()
    {
        return view('my-profile');
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

}
