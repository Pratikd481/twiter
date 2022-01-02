@extends('layouts.front-end-app')

@section('content')

    {{-- Start post create --}}
    <x-post-create />
    {{-- End post create --}}



    {{-- Start post list --}}
    <x-posts-list :posts="$posts" />
    {{-- End post list --}}


@endsection

