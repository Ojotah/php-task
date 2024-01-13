@auth()
    <h4> Share yours post </h4>
    <div class="row">
        <form action="{{ route('posts.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <textarea name="post" class="form-control" id="idea" rows="3"></textarea>
                @error('post')
                    <span class="d-block fs-6 text-danger mt-2">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-outline-primary">Share</button>
            </div>
        </form>
    </div>
@endauth
@guest
    <h4>Log in to share your posts </h4>
@endguest
