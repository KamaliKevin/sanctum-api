<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Registers a user throughout the API
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return response()->json([
            'message' => "Registration was successful",
            'information' => [
                'name' => $user->name,
                'email' => $user->email,
            ]
        ], 200);
    }

    /**
     * Allows a user to log in throughout the API
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where('email',  $request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password))
        {
            return response()->json([
                'message' => "Username or password is incorrect",
            ], 422);
        }

        $user->tokens()->delete(); // Deletes an old token

        return response()->json([
            'message' => "User logged in successfully",
            'token' => $user->createToken('auth_token')->plainTextToken,
        ], 200);
    }

    /**
     * Allows a user to log out throughout the API
     */
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => "User logged out successfully"], 200);
    }
}
