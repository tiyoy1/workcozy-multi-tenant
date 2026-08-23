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

        if ($workspace == null) {
            return $next($request);
        }

        if ( ! $user->workspaces()->where('workspaces.id', $workspace->id)->exists()) {
            abort(403);
        }

        return $next($request);
    }
}
