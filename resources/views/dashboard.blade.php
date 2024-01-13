@extends('layouts.layout')
@section('content')
    <div class="row">
        <div class="col-3">
        </div>
        <div class="col-6">
            @include('shared.success_message')
            @include('shared.submit_post')
            <hr>
            @forelse ($posts as $post)
                @include('shared.card')
            @empty
            <p class="text-center mt-4">No result found.</p>
            @endforelse
            {{ $posts->links() }}
        </div>
        <div class="col-3">
        </div>
    </div>
@endsection
