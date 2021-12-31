@extends('layouts.app')

@section('content')

    <div class="panel profile-cover">
        <div class="profile-cover__img">
            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="" />
            <h3 class="h3">Henry Foster</h3>
        </div>
        <div class="profile-cover__action bg--img" data-overlay="0.3">
            <button class="btn btn-rounded btn-info">
                <i class="fa fa-plus"></i>
                <span>Follow</span>
            </button>

        </div>
        <div class="profile-cover__info">
            <ul class="nav">
                <li><strong>26</strong>Posts</li>
                <li><strong>33</strong>Followers</li>
                <li><strong>136</strong>Following</li>
            </ul>
        </div>
    </div>
    <div class="card">


        <div class="card-body">
            <textarea name="user_activity" placeholder="Share what you've been up to..." class="form-control"></textarea>
        </div>
        <div class="card-header publish-twit">
            <div class="row">
                <div class="col-sm-6 ">
                    <img src="https://i.imgur.com/bDLhJiP.jpg" width="50" class="rounded-circle">
                </div>
                <div class="col-sm-6 ">
                    <button class="btn  btn-sm btn-primary float-right publish-btn ">
                        {{ __('Publish') }}
                    </button>
                </div>
            </div>

        </div>
    </div>
    <div class="card posts">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <span class="image"></span>
                        <img src="https://i.imgur.com/bDLhJiP.jpg" width="50" class="rounded-circle">
                        <span class="title"> Pratik das </span>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">

                        <span class="post-details">
                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tempore, quaerat. Sapiente
                            nesciunt, repellendus reiciendis explicabo eligendi fuga laboriosam nisi, assumenda
                            fugiat suscipit nostrum saepe magni iure. Assumenda velit culpa enim.
                        </span>
                    </div>
                </div>


            </div>

        </div>
    </div>

@endsection
