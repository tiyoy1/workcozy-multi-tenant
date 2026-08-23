<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' =>['required'],
        ]);

        if ( ! Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

            /** @var \App\Models\User $user */

            $user = Auth::user();
            
            $token = $user->createToken('postman-login')->plainTextToken;
            return response()->json([
                'token' => $token
            ], 201);
        
    }
}
