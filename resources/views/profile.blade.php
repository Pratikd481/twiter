@extends('layouts.front-end-app')

@section('content')

    <div class="panel profile-cover">
        <div class="profile-cover__img">
            <img src="{{ $profile_data->image }}" alt="" width="80" />
            <h3 class="h3">{{ $profile_data->name }}</h3>
        </div>
        <div class="profile-cover__action bg--img" data-overlay="0.3">
            @if (\Auth::id() == $profile_data->id)
                {{-- <button class="btn btn-rounded btn-info">
                <i class="fa fa-plus"></i>
                <span>{{ __('Update') }}</span>
            </button> --}}
            @else
                <x-follow-button :user="$profile_data" />
            @endif

        </div>
        <div class="profile-cover__info">
            <ul class="nav">
                <li><strong>{{ count($profile_data->posts) }}</strong>Posts</li>
                <li><strong>{{ count($profile_data->followedBy) }}</strong>Followers</li>
                <li><strong>{{ count($profile_data->following) }}</strong>Following</li>
            </ul>
        </div>
    </div>

    @if (\Auth::id() == $profile_data->id)
        {{-- Start post create --}}
        <x-post-create />
        {{-- End post create --}}
    @endif

    {{-- Start post list --}}
    <x-posts-list :posts="$posts" />
    {{-- End post list --}}

@endsection

@push('scripts')
    <script>
        $('.posts .publish-btn').click(function() {
            $(this).prop('disabled', true);
            $(this).html('Updating..');
            var route = $(this).data('route');
            var description = $(this).parents('.update-div').find('.description').val();
            updateListItem(route, description, $(this));
        });

        function setValidationError(result, element) {
            var description_element = $(element).parents('.update-div').find('.description');
            if (result.errors.description != undefined) {
                description_element.addClass('is-invalid');
                description_element.siblings('.invalid-feedback').html(result.errors.description[0]);

            } else {
                description_element.removeClass('is-invalid');
                description_element.siblings('.invalid-feedback').html();
            }

            $(element).prop('disabled', false);
            $(element).html('Update');
        }
    </script>
@endpush
