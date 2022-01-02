@if ($user->isFollowing == 'NO')
    <button class="btn  btn-sm btn-primary float-right follow-btn "
        data-route="{{ route('user.follow', ['user' => $user->uuid]) }}">
        {{ __('Follow') }}
    </button>
@else
    <button class="btn  btn-sm btn-warning float-right follow-btn "
        data-route="{{ route('user.follow', ['user' => $user->uuid]) }}">
        {{ __('Unfollow') }}
    </button>
@endif
@push('scripts')
    <script>
        $(document).on('click', '.follow-btn', function(event) {
            event.stopPropagation();
            event.stopImmediatePropagation();
            var route = $(this).data('route');
            $(this).prop('disabled', true);
            followUser(route)

        });

        function followUser(route) {
            $.ajax({
                url: route,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: {
                    "_method": 'put',
                },
                contentType: 'application/json',
                dataType: 'JSON',
                success: function(result) {
                    location.reload();
                },
                error: function(result) {
                    alert('Some thing went wrong.');
                }
            });
        }
    </script>
@endpush
