@if (Session::has('post-create-message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('post-create-message') }}</p>
@endif
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div class="card">
        <div class="card-body">
            <textarea name="description" placeholder="Share what you've been up to..."
                class="form-control @error('description') is-invalid @enderror"></textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
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
</form>
