@extends('layouts.front-end-app')

@section('content')
    <div class="card explore">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('user.profile', ['user' => 'test']) }}">
                            <img src="https://i.imgur.com/bDLhJiP.jpg" width="50" class="rounded-circle">
                            <span class="title"> Pratik das </span>
                        </a>
                    </div>
                    <div class="col-sm-6 ">
                        <button class="btn  btn-sm btn-primary float-right follow-btn ">
                            {{ __('Follow') }}
                        </button>
                    </div>

                </div>


            </div>

        </div>
    </div>
    <div class="card explore">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{ route('user.profile', ['user' => 'test']) }}">
                            <img src="https://i.imgur.com/bDLhJiP.jpg" width="50" class="rounded-circle">
                            <span class="title"> Pratik das </span>
                        </a>
                    </div>
                    <div class="col-sm-6 ">
                        <button class="btn  btn-sm btn-primary float-right follow-btn ">
                            {{ __('Follow') }}
                        </button>
                    </div>

                </div>



            </div>

        </div>
    </div>
@endsection
