<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->get();
        return response()->json($posts,200);
    }
    public function show(Post $post)
    {
        return response()->json($post->load('user'),200);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|file|mimes:jpg,jpeg,png,mp4,mov,avi|max:20480',
            'caption' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('content')) {
            $path = $request->file('content')->store('public/posts');
            $validated['content'] = Storage::url($path);
        }

        $post= Auth::user()->posts()->create($validated);

        return response()->json($post,201);
    }

    public function update(Request $request, Post $post)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'sometimes|file|mimes:jpg,jpeg,png|max:20480',
            'caption' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $validatedData = $validator->validated();


        if ($request->hasFile('content')) {
            if (Storage::exists($post->content)) {
                Storage::delete($post->content);
            }


            $path = $request->file('content')->store('public/posts');
            $validatedData['content'] = Storage::url($path);
        }

        $post->update($validatedData);

        return response()->json($post, 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(null, 204);
    }
}

