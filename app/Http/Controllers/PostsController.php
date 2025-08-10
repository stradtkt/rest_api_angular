<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // GET /api/posts
    public function getPosts()
    {
        return response()->json(Post::with('user')->latest()->get());
    }

    // GET /api/posts/{id}
    public function getPost($id): \Illuminate\Http\JsonResponse
    {
        $post = Post::with('user')->findOrFail($id);
        return response()->json($post);
    }

    // POST /api/posts
    public function createPost(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::create($validated);
        return response()->json($post, 201);
    }

    // PUT /api/posts/{id}
    public function updatePost(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $post = Post::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
        ]);

        $post->update($validated);
        return response()->json($post);
    }

    // DELETE /api/posts/{id}
    public function deletePost($id): \Illuminate\Http\JsonResponse
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return response()->json(['message' => 'Post deleted']);
    }

    // GET /api/posts/count
    public function countPosts(): \Illuminate\Http\JsonResponse
    {
        $count = Post::count();
        return response()->json(['total_posts' => $count]);
    }
}
