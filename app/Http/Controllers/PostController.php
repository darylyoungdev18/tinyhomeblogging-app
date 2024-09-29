<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use Illuminate\Support\Facades\Auth; // Import Auth facade if needed



class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->take(3)->get();

        return view('posts.index', compact('posts'));  // this grab the latest post
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allCategories = Category::all();
        return view('posts.create', compact('allCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $validateData = $request->validate([
        'title' => 'required|unique:posts|max:255',
        'subtitle' => 'nullable|max:255',
        'body' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048'
    ]);

    if ($request->hasFile('image')) {
        $imageName = time() . '_' . $request->image->getClientOriginalName();
        $request->image->storeAs('images', $imageName, 'public');
        $validatedData['image'] = $imageName;
    }

    $post = new Post();
    $post->title = $validatedData['title'];
    $post->subtitle = $validatedData['subtitle'] ?? null;
    $post->body = $validatedData['body'];
    $post->user_id = auth()->id(); // Assumes the user is authenticated may not need this
    $post->image = $validatedData['image'] ?? null;
    $post->save();

    if ($request->has('category_ids')) {
        $post->categories()->sync($request->input('category_ids'));
    }


    // Redirect to the newly created post's page with a success message
    return redirect()->route('posts.show', $post)->with('success', 'Post created successfully!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $allCategories = Category::all();
        return view('posts.show', compact('post', 'allCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:posts,title,' . $post->id . '|max:255',
            'subtitle' => 'nullable|max:255',
            'body' => 'required',
            'image'=> 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);


        if ($request->hasFile('image')) {
            if ($post->image) {
                Storage::disk('public')->delete('images/' . $post->image); // Delete the old image if it exists
            }
    
            $imageName = time() . '_' . $request->image->getClientOriginalName();
            $request->image->storeAs('images', $imageName, 'public');
            $validatedData['image'] = $imageName;
        }    
    
        // Update the post with validated data
        $post->update($validatedData);

        if ($request->has('category_ids')) {
            $post->categories()->sync($request->input('category_ids')); // -> selects properties and activate methods in object
        } else {
            $post->categories()->detach();
        }
    
    
        // Redirect to the post's page with a success message
        return redirect()->route('posts.show', $post)->with('success', 'Post updated successfully!');
    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if ($post->image) {
            Storage::disk('public')->delete('images/' . $post->image);
        }
        
        $post->delete();

        return redirect()->route('posts.index');
    }
}
