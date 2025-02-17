<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ApiResponse;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Post::with('user')->get();

        return ApiResponse::success($posts, "List of posts retrieved successfully");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => $validated['user_id'],
        ]);

        return ApiResponse::success($post, "Post created successfully", 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $post = Post::with('user')->find($id);

        if (!$post) {
            return ApiResponse::error("Post not found", [], 404);
        }

        return ApiResponse::success($post, "Post details retrieved successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $post = Post::find($id);

        if (!$post) {
            return ApiResponse::error("Post not found", [], 404);
        }

        $post->update($validated);
        return ApiResponse::success($post, "Post updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $post = Post::find($id);

        if (!$post) {
            return ApiResponse::error("Post not found", [], 404);
        }

        $post->delete();

        return ApiResponse::success([], "Post deleted successfully", 200);
    }
}
