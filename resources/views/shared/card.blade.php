<div class="mt-3">
    <div class="card">
        <div class="px-3 pt-4 pb-2">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:50px" class="me-2 avatar-sm rounded-circle" src="{{ $post->user->getImageURL() }}"
                        alt="{{ $post->user->name }}">
                    <div>
                        <h5 class="card-title mb-0"><a href="{{ route('users.show', $post->user->id) }}">
                                {{ $post->user->name }}
                            </a></h5>
                    </div>
                </div>
                <div>
                    <form method="POST" action="{{ route('posts.destroy', $post->id) }}">
                        @csrf
                        @method('delete')
                        <button class="btn btn-danger btn-sm">x</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="fs-6 fw-light text-muted">
                {{ $post->content }}
            </p>
            <div class="d-flex justify-content-between">
                <div>
                    <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-heart me-1">
                        </span> {{ $post->likes }} </a>
                </div>
                <div>
                    <span class="fs-6 fw-light text-muted"> <span class="fas fa-clock"> </span>
                        {{ $post->created_at }} </span>
                </div>
            </div>
            <div>
                <form action="{{ route('posts.comments.store', $post->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <textarea name="content" class="fs-6 form-control" rows="1"></textarea>
                    </div>
                    <div>
                        <button type="submit " class="btn btn-primary btn-sm"> Post Comment </button>
                    </div>
                </form>
                <hr>
                @foreach ($post->comments as $comment)
                    <div class="d-flex align-items-start">
                        <img style="width:35px" class="me-2 avatar-sm rounded-circle"
                            src="{{ $comment->user->getImageURL() }}" alt="{{ $comment->user->name }}">
                        <div class="w-100">
                            <div class="d-flex justify-content-between">
                                <h6 class="">{{ $comment->user->name }}
                                </h6>
                                <small class="fs-6 fw-light text-muted"> {{ $comment->created_at }}</small>
                            </div>
                            <p class="fs-6 mt-3 fw-light">
                                {{ $comment->content }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
