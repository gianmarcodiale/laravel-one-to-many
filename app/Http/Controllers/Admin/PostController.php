<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderByDesc('id')->get();
        //dd($posts);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Pass all the category list to the create function in the PostController
        $categories = Category::all();
        // dd($categories);
        // Return view with form for creating a new post
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        //dd($request->all());
        // Store the newly created post into the database
        // Validate data
        $validated_data = $request->validated();
        // Verify if inserted id exist in the category list -> check PostRequest.php
        // Generate slug for new post
        $slug = Post::generateSlug($request->title);
        // Save the validated slug into the slug param
        $validated_data['slug'] = $slug;
        //dd($validated_data);
        // Create the new post
        Post::create($validated_data);
        // Redirect to GET route
        return redirect()->route('admin.posts.index')->with('message', 'Post Created Succesfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // Return the single post by clicking on view btn
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        // Pass all the category list to the create function in the PostController
        $categories = Category::all();
        // Return view with the form for editing the single post
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PostRequest $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {
        // Return the updated data from the single post
        // Create the variable with the validated data
        $validated_data = $request->validated();
        // Generate slug with the post title by defining a function for the Str in the
        $slug = Post::generateSlug($request->title);
        // dd($slug);
        // Save the validated slug into the slug param
        $validated_data['slug'] = $slug;
        // Create instance
        $post->update($validated_data);
        // Redirect to a GET route
        return redirect()->route('admin.posts.index')->with('message', 'Post Updated Succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        // Create a route for post delete
        $post->delete();
        // Redirect to a GET route
        return redirect()->route('admin.posts.index')->with('message', 'Post Deleted Succesfully');
    }
}
