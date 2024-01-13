<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function show(User $user)
    {
        $posts = $user->posts()->paginate(5);
        return view('users.show', compact('user', 'posts'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $editing = true;
        $posts = $user->posts()->paginate(5);
        return view('users.show', compact('user', 'editing', 'posts'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        $validated = request()->validate(
            [
                'name' => 'required|min:3|max:20',
                'bio' => 'nullable|min:3|max:255',
                'image' => 'image',
                'email' => 'required|email',
            ]
        );
        if (request()->has('image')) {
            $imagePath = request()->file('image')->store('profile', 'public');
            $validated['image'] = $imagePath;
            Storage::disk('public')->delete($user->image);
        }
        $user->update($validated);
        return redirect()->route('profile');
    }
    public function profile()
    {
        return $this->show(auth()->user());
    }
    public function destroy($id)
    {
        $user = User::where('id', $id)->firstOrFail()->delete();
        return redirect()->route('dashboard')->with('success', 'Account deleted successfully');
    }
}
