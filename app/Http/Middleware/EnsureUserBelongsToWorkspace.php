<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class EnsureUserBelongsToWorkspace
{
    /**
     * Handle an incoming request.
     *
     * @param Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();        
        $workspace = $request->route('workspace');

        // dd([
        //     '1_is_it_a_string' => is_string($workspace),
        //     '2_what_is_the_variable' => $workspace,
        //     '3_what_workspaces_does_user_have' => $user->workspaces->pluck('slug')->toArray()
        // ]);
        // dd($workspaceSlug);
        
        // dd($user, $workspaceSlug);

        // dd($user->id, $user->workspaces->pluck('id', 'slug'));

        // if( ! $user->workspaces()->where('workspaces.slug', $workspaceSlug->slug)->exists()) {
        //     abort(403); //masalahnya ya jaipuloh, kalo ga ada ->slug jadi ga bisa buka workspace, 403 forbidden blok.
        // }

        if ( ! $user->workspaces()->where('workspaces.id', $workspace->id   )->exists()) {
            abort(403);
        }

        return $next($request);
    }
}
