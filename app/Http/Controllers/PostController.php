<?php

namespace App\Http\Controllers;

use Yajra\DataTables\DataTables;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $r)
    {
        // $posts = Post::where('is_published', 1)
        //     ->latest()
        //     ->get();
        // return view('post.postshow', compact('posts'));

        //for the ajax

        if ($r->ajax()) {
            // $data = Post::where('is_published', 1);
            $data = Post::all();



            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('title', function ($post) {
                    return '<strong id="getTitle">' . htmlspecialchars($post->title) . '</strong>';
                })
                ->editColumn('content', function ($post) {
                    return '<p id="getContent">' . htmlspecialchars($post->content) . '</p>';
                })


                ->addColumn('image', function ($post) {
                    if (
                        $post->image && Storage::disk('public')->exists($post->image)
                    ) {
                        return '<img src="' . asset('storage/' . $post->image) . '"
                     style="width:70px; height:50px; object-fit:cover; border-radius:6px;">';
                    }
                    return '<span style="color:#9ca3af;">No Image</span>';
                })

                
                //new action column

                ->addColumn('action', function ($post) {
                    return '
                        <button
                            onclick="openEditModal($(this))"
                            style="padding:6px 10px; background:#f59e0b; color:#fff; border:none; border-radius:5px;" data-link="' . route('posts.edit', $post->id) . '">
                            Edit
                        </button>

                        <button
                                onclick="deletePost(' . $post->id . ')"
                                style="padding:6px 10px; background:#dc2626; color:#fff; border:none; border-radius:5px;">
                                Delete
                            </button>
                        ';
                })







                ->rawColumns(['title', 'content', 'image', 'action'])
                ->make(true);

            //. route('posts.destroy', $post->id)
        }


        return view('post.postshow');
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
    public function edit($id)
    {
        $post = Post::findorfail($id);
        return view('post.editpost', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, Post $post)
    // {
    //     $data = $request->validate([
    //         'title'   => 'required|string|max:255',
    //         'content' => 'required|string',
    //         'image'   => 'nullable|image|max:2048',
    //     ]);

    //     if ($request->hasFile('image')) {
    //         if ($post->image && Storage::exists($post->image)) {
    //             Storage::delete($post->image);
    //         }

    //         $data['image'] = $request->file('image')->store('posts');
    //     }

    //     $post->update($data);

    //     return back()->with('success', 'Post updated successfully');
    // }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {

            // delete old image (from public disk)
            if ($post->image && Storage::disk('public')->exists($post->image)) {
                Storage::disk('public')->delete($post->image);
            }

            // save new image (public disk)
            $data['image'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return back()->with('success', 'Post updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // Delete image from storage
        if ($post->image && Storage::disk('public')->exists($post->image)) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();

        return response()->json(['success' => 'Post deleted successfully']);
    }

    public function approve($id)
    {
        $post = Post::findOrFail($id);
        $post->is_published = 1;
        $post->save();

        return back()->with('success', 'Post approved successfully');
    }


    public function approvingPosts()
    {
        // $posts = Post::where('is_published', 0)->get();
        // return view('admin.approving_posts', compact('posts'));
        $posts = Post::where('is_published', 0)
            ->latest()
            ->get();
        return view('post.post', compact('posts'));
    }
}
