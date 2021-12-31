@extends('layouts.app')

@section('content')
    <div class="card explore">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <span class="image"></span>
                        <img src="https://i.imgur.com/bDLhJiP.jpg" width="50" class="rounded-circle">
                        <span class="title"> Pratik das </span>
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
                        <span class="image"></span>
                        <img src="https://i.imgur.com/bDLhJiP.jpg" width="50" class="rounded-circle">
                        <span class="title"> Pratik das </span>
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
