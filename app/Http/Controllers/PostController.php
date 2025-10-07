<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::with('category')->latest()->get();
        return view('index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',

        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $request->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $image = time() . '.' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $image);
        }

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $image;
        $post->category_id = $request->category_id;
        $post->user_id = Auth::user()->id;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image = $imagePath;
        }

        $post->save();
        flash()->success('Post created successfully!');
        return redirect()->route('dashboard.posts');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        $user = User::findOrFail($post->user_id);
        $post->user = $user;
        $post->load('comments', 'category');
        return view('postDetails', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $categories = Category::all();
        return view('posts.create', ['post' => $post, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',

        ]);
        $post = Post::findOrFail($id);

        $image = $post->image;
        if ($request->hasFile('image')) {
            $request->validate(['image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
            // Delete old image if exists
            if ($image) {
                $imagePath = public_path('images/') . $image;
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $image = time() . '.' . $request->image->getClientOriginalName();
            $request->image->move(public_path('images'), $image);
        }


        $post->title = $request->title;
        $post->content = $request->content;
        $post->image = $image;
        $post->category_id = $request->category_id;


        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image = $imagePath;
        }

        $post->save();
        flash()->success('Post updated successfully!');
        return redirect()->route('dashboard.posts');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $image = $post->image;
        if ($image) {
            $imagePath = public_path('images/') . $image;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $post->delete();
        flash()->success('Post deleted successfully!');
        return redirect()->route('dashboard.posts');
    }
}
