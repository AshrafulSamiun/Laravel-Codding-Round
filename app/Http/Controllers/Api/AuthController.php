<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Exception;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        try {

            $data = $request->validate([
                'name' => 'required|string|min:3',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);

            return response()->json([
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'created_at' => $user->created_at,
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed.',
                'errors' => $e->errors(),
            ], 422);

        } catch (Exception $e) {
            Log::error('Registration failed: ' . $e->getMessage());

            return response()->json([
                'message' => 'Something went wrong. Please try again later.',
            ], 500);
        }
    }
}
