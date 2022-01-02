@extends('layouts.front-end-app')
@section('content')
    @foreach ($explore_users as $user)
        <div class="card explore">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('user.profile', ['user' => $user->uuid]) }}">
                                <img src="{{ $user->image }}" width="50" class="rounded-circle">
                                <span class="title"> {{ $user->name }}</span>
                            </a>
                        </div>
                        <div class="col-sm-6 ">
                            <x-follow-button :user="$user" />

                        </div>

                    </div>


                </div>

            </div>
        </div>
    @endforeach

    <br>

    {{ $explore_users->links('pagination.pagination-view') }}
@endsection
