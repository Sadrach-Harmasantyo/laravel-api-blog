<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::with('posts')->get();

        return ApiResponse::success($users, "List of users retrieved successfully");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // $user = User::create($request->all());

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);

        return ApiResponse::success($user, "User created successfully", 201);
    }

    public function login(Request $request)
    {
        //
        $validated = $request->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);

        $user = User::where('email', $validated['email'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return ApiResponse::error("Invalid credentials", [], 401);
        }

        return ApiResponse::success($user, "User logged in successfully", 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $user = User::with('posts')->findOrFail($id);

        if (!$user) {
            return ApiResponse::error("User not found", [], 404);
        }

        return ApiResponse::success($user, "User details retrieved successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
        ]);

        $user = User::findOrFail($id);

        if (!$user) {
            return ApiResponse::error("User not found", [], 404);
        }

        $user->update($validated);
        return ApiResponse::success($user, "User updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $user = User::findOrFail($id);

        if (!$user) {
            return ApiResponse::error("User not found", [], 404);
        }

        $user->delete();

        return ApiResponse::success([], "User deleted successfully", 200);
    }
}
