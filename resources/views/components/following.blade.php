<div class="col-md-3">
    <div class="card following">
        <div class="card-body">
            <h4>Following</h4>
            @foreach ($users as $user)
                <div class="card">
                    <div class="card-header publish-twit">
                        <div class="row">
                            <div class="col-sm-6 ">
                                <a href="{{ route('user.profile', ['user' => $user->uuid]) }}">
                                    <img src="{{ $user->getImage()}}" width="30" class="rounded-circle">
                                    <span class="title">{{ $user->name}} </span>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            @endforeach


        </div>
    </div>
</div>
