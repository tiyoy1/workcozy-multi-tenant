<?php

use App\Http\Controllers\Api\LoginController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\EnsureUserBelongsToWorkspace;
use App\Http\Controllers\PostController;
use App\Http\Controllers\WorkspaceController;
use App\Http\Resources\PostResource;
use App\Models\Post;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [LoginController::class, 'authenticate']);

Route::middleware('auth:sanctum')->group(function () {
    Route::middleware(EnsureUserBelongsToWorkspace::class)
        ->prefix('/workspaces/{workspace:slug}')
        ->group(function() {
            Route::resource('posts', PostController::class);
    });
    
    Route::middleware(EnsureUserBelongsToWorkspace::class)->group(function () {
        Route::resource('workspaces', WorkspaceController::class);
    });
});