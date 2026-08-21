<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Workspace;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Workspace $workspace)
    {
        // return view('dashboard')
        $posts = $workspace->posts()->latest()->get();

        return view('posts.index', [
            'workspace' => $workspace,
            'posts' => $posts
        ]);

        // $posts = Post::all();
        // return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Workspace $workspace)
    {
        return view('posts.create', ['workspace' => $workspace]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, Workspace $workspace) 
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
        ]);

        // dd($validatedData);

        $workspace->posts()->create($validatedData);

        return redirect()->route('posts.index', $workspace);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace, Post $post)
    {
        return view('posts.show', [
            'workspace' => $workspace,
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workspace $workspace, Post $post)
    {
        // dd($post);
        
        return view('posts.edit', [
            'post' => $post,
            'workspace' => $workspace,
        ]); //ga perlu compact euy karena udah bikin array sendiri anjay
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Workspace $workspace, Post $post)
    {
        // dd($post); bro im actually crackedd!!! 
    
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'nullable|string',
        ]);

        // dd($validatedData);

        $post->update($validatedData);
        return redirect()->route('posts.index', $workspace);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workspace $workspace, Post $post)
    {
        // dd($post); //berarti error terjadi sebelum function ini kepanggil wey
        // $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('posts.index', $workspace);
    }
}
