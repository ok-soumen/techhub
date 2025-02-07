<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'mobileNumber' => 'required|string|unique:users,mobileNumber',
            'dob' => 'nullable|date',
            'address' => 'nullable|string',
            'course_type' => 'nullable|string',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin,teacher',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobileNumber' => $request->mobileNumber,
            'dob' => $request->dob,
            'address' => $request->address,
            'course_type' => $request->course_type,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'mobileNumber' => 'required|string',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt(['mobileNumber' => $request->mobileNumber, 'password' => $request->password])) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $user = Auth::user();
        $token = $user->createToken('authToken')->plainTextToken; // ✅ Ensure this is correct

        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }
}
