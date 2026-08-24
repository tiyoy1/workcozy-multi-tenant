<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Http\Resources\WorkspaceResource;
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
        $posts = $workspace->posts()->with('user')->latest()->get();

        return response()->json([
            'workspace' => new WorkspaceResource($workspace),
            'posts' => PostResource::collection($posts),
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Workspace $workspace)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, Workspace $workspace) 
    {
        $validatedData = $request->validated();

        $post = Post::create([
            'title' => $validatedData['title'],
            'body' => $validatedData['body'],
            'workspace_id' => $workspace->id,
            'user_id' => $request->user()->id,
        ]);

        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace, Post $post)
    {
        return response()->json([
            'workspace' => new WorkspaceResource($workspace),
            'post' => new PostResource($post),
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workspace $workspace, Post $post)
    {     
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Workspace $workspace, Post $post)
    {
    
        $validatedData = $request->validated();

        $post->update($validatedData);

        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workspace $workspace, Post $post)
    {
        $post->delete();
        return response()->json([
            'workspace' => $workspace
        ], 200);
    }
}
