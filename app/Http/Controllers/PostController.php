<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('is_published', 0)
            ->latest()
            ->get();
        return view('post.post', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) {}


    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
        }

        Post::create([
            'title'   => $request->title,
            'content' => $request->content,
            'image'   => $imagePath,
        ]);

        return back()->with('success', 'Post created successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Post $post) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post) {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($post->image && Storage::exists($post->image)) {
                Storage::delete($post->image);
            }

            $data['image'] = $request->file('image')->store('posts');
        }

        $post->update($data);

        return back()->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }

    public function approve($id)
    {
        $post = Post::findOrFail($id);
        $post->is_published = 1;
        $post->save();

        return back()->with('success', 'Post approved successfully');
    }
}
