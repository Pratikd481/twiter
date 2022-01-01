@extends('layouts.front-end-app')

@section('content')

    <div class="panel profile-cover">
        <div class="profile-cover__img">
            <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="" />
            <h3 class="h3">Henry Foster</h3>
        </div>
        <div class="profile-cover__action bg--img" data-overlay="0.3">
            <button class="btn btn-rounded btn-info">
                <i class="fa fa-plus"></i>
                <span>{{ __('Update') }}</span>
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
    {{-- Start post create --}}
    <x-post-create />
    {{-- End post create --}}
    <div class="card posts">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <span class="image"></span>
                        <img src="https://i.imgur.com/bDLhJiP.jpg" width="50" class="rounded-circle">
                        <span class="title"> Pratik das </span>
                    </div>
                    <div class="col-md-4">
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false" v-pre>
                                {{ __('Action') }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Edit</a>
                                <a class="dropdown-item" href="#">Delete</a>
                            </div>
                        </div>
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
