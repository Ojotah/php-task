<div class="card">
    <div class="px-3 pt-4 pb-2">
        <form enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}" method="post">
            @csrf
            @method('put')
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center">
                    <img style="width:150px" class="me-3 avatar-sm rounded-circle" src="{{ $user->getImageURL() }}"
                        alt="Mario Avatar">
                    <div>
                        @if ($editing ?? false)
                            <input name="name" value="{{ $user->name }}" type="text" class="form-control">
                            @error('name')
                                <span class="text-danger fs-6">{{ $message }}</span>
                            @enderror
                        @else
                            <h3 class="card-title mb-0"><a href="#"> {{ $user->name }}
                                </a></h3>
                        @endif
                        @if ($editing ?? false)
                            <input name="email" value="{{ $user->email }}" type="email" class="form-control mt-3">
                            @error('email')
                                <span class="text-danger fs-6">{{ $message }}</span>
                            @enderror
                        @else
                            <span class="fs-6 text-muted">{{ $user->email }}</span>
                        @endif
                    </div>
                </div>
                @auth
                    @if (Auth::id() === $user->id)
                        @if ($editing ?? false)
                            <div>
                                <a href="{{ route('users.show', $user->id) }}">View</a>
                            </div>
                        @else
                            <div>
                                <a href="{{ route('users.edit', $user->id) }}">Edit</a>
                            </div>
                        @endif
                    @endif
                @endauth
            </div>
            @if ($editing ?? false)
                <div class="mt-5">
                    <label for="">Profile image</label>
                    <input name="image" type="file" class="form-control">
                </div>
            @endif
            <div class="px-2 mt-4">
                <h5 class="fs-5"> About : </h5>
                @if ($editing ?? false)
                    <div class="mb-3">
                        <textarea name="bio" id="bio" rows="3" class="form-control">{{ $user->bio }}</textarea>
                        @error('bio')
                            <span class="d-block fs-6 text-danger mt-2"> {{ $message }} </span>
                        @enderror
                    </div>
                    <div>
                        <button class="btn btn-dark btn-sm mb-3">Save</button>
                    </div>
                    <div>
                        <a class="" href="{{ route('change-password') }}">Change password</a>
                    </div>
                @endif
                @auth
                    @if (Auth::id() == $user->id)
                        @if ($editing ?? false)
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit"
                                    onclick="return confirm('Are you sure?,all your data will be deleted')"
                                    class="btn btn-danger btn-sm" href="{{ route('users.destroy', $user->id) }}">Delete
                                    account</button>
                        @endif
                    @endauth
                @endif
        </form>
        <p class="fs-6 fw-light">
            {{ $user->bio }}
        </p>
        <div class="d-flex justify-content-start">
            <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="fas fa-user me-1">
                </span> 120 Followers </a>
            <a href="#" class="fw-light nav-link fs-6 me-3"> <span class="me-1">Posts:
                </span> {{ $user->posts()->count() }} </a>
            <a href="#" class="fw-light nav-link fs-6"> <span class="fas fa-comment me-1">
                </span> {{ $user->comments()->count() }} </a>
        </div>
        <a href="#" class="fw-light nav-link fs-6"><span class="me-1">Register date:
            </span> {{ $user->created_at }} </a>
        @auth
            @if (Auth::id() !== $user->id)
                <div class="mt-3">
                    <button class="btn btn-primary btn-sm"> Follow </button>
                </div>
            @endif
        @endauth
    </div>
    </form>
</div>
</div>
