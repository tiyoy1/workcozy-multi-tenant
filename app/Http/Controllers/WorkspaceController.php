<?php

namespace App\Http\Controllers;

use App\Models\Workspace;
use App\Models\User;
use App\Http\Requests\StoreWorkspaceRequest;
use App\Http\Requests\UpdateWorkspaceRequest;
use Laravel\Mcp\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Membership;

class WorkspaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Workspace $workspace, User $user, Request $request)
    {
        return response()->json([
            'name' => $request->user()->name,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWorkspaceRequest $request, User $user)
    {
        $validatedWorkspace = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $slug = Str::of($request->name . ' Workspace')->slug();

        $workspace = Workspace::create([
            'name' => $validatedWorkspace['name'],
            'slug' => $slug,
        ]);

        // dd($workspace);

        Membership::create([
            'membership_role' => 'owner',
            'user_id' => Auth::id(),
            'workspace_id' => $workspace->id,
        ]);
        
        return response()->json([
            'workspace_slug' => $workspace->slug,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Workspace $workspace)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Workspace $workspace)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWorkspaceRequest $request, Workspace $workspace)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Workspace $workspace)
    {
        //
    }
}
