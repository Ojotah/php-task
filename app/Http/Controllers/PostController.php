<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return view('posts.show', [
            'post' => $post
        ]);
    }
    public function store()
    {
        $validated = request()->validate([
            'post' => 'required|min:5|max:260'
        ]);
        $post = post::create(
            [
                'content' => request()->get('post', ''),
                'user_id' => auth()->id()
            ]
        );
        // $validated['user_id'] = auth()->id();
        //  Post::create($validated);
        return redirect()->route('dashboard')->with('success', 'post shared successfully');
    }
    public function destroy(Post $id)
    {
        if (auth()->id() !== $id->user_id) {
            abort(404);
        }
        $id->delete();
        return redirect()->route('dashboard')->with('success', 'post deleted successfully');
    }
}
