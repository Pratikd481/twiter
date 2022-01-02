<div class="post-div">
    @foreach ($posts as $post)
        <div class="card posts">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-8">
                            <img src="{{ $post->user->image }}" width="50" class="rounded-circle">
                            <span class="title"> {{ optional($post->user)->name ?? '' }}</span>
                        </div>
                        @if (\Auth::id() == $post->user->id)
                            <div class="col-md-4 post-action">
                                <div class="dropdown">
                                    <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ __('Action') }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item edit" href="javascript:void(0);"
                                           >Edit</a>
                                        <a class="dropdown-item delete"
                                            data-route="{{ route('posts.destroy', ['post' => $post->uuid]) }}"
                                            href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                        @endif


                    </div>
                    <div class="row description-div">
                        <div class="col-md-12">

                            <span class="post-details">
                                {!! $post->description !!}
                            </span>
                        </div>
                    </div>
                    <div class="card update-div" style="display: none">
                        <div class="card-body">
                            <textarea name="description" placeholder="Share what you've been up to..."
                                class="form-control description">{!! $post->description !!}</textarea>
                            <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="card-header publish-twit">
                            <div class="row">
                                <div class="col-sm-6 ">
                                    <img src="{{ $post->user->image }}" width="50" class="rounded-circle">
                                </div>
                                <div class="col-sm-6 ">
                                    <button class="btn  btn-sm btn-primary float-right publish-btn "  data-route="{{ route('posts.update', ['post' => $post->uuid]) }}">
                                        {{ __('Update') }}
                                    </button>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
    @endforeach
    <br>

    {{ $posts->links('pagination.pagination-view') }}

</div>
