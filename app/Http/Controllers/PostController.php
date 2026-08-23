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

        // return view('posts.index', [
        //     'workspace' => $workspace,
        //     'posts' => $posts
        // ]);

        return response()->json([
            'workspace' => $workspace,
            'posts' => $posts,
        ], 200);

        // $posts = Post::all();
        // return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Workspace $workspace)
    {
        return response()->json([
            'workspace' => $workspace
        ], 200);
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

        $post = Post::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'workspace_id' => $workspace->id,
            'user_id' => $request->user()->id,
        ]);

        return response()->json($post, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace, Post $post)
    {
        return response()->json([
            'workspace' => $workspace,
            'post' => $post,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workspace $workspace, Post $post)
    {
        // dd($post);
        
        return response()->json([
            'post' => $post,
            'workspace' => $workspace,
        ], 200); //ga perlu compact euy karena udah bikin array sendiri anjay
        
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

        // $post->update($validatedData);
        return response()->json($post, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workspace $workspace, Post $post)
    {
        // dd($post); //berarti error terjadi sebelum function ini kepanggil wey
        // $post = Post::findOrFail($id);
        $post->delete();
        return response()->json([
            'workspace' => $workspace
        ], 201);
    }
}
