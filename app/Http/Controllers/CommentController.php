<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // GET /api/comments
    public function getAll()
    {
        return response()->json(Comment::with(['user', 'post'])->latest()->get());
    }

    // GET /api/comments/{id}
    public function getById($id)
    {
        $comment = Comment::with(['user', 'post'])->findOrFail($id);
        return response()->json($comment);
    }

    // POST /api/comments
    public function create(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'post_id' => 'required|exists:posts,id',
            'content' => 'required|string',
        ]);

        $comment = Comment::create($validated);
        return response()->json($comment, 201);
    }

    // PUT /api/comments/{id}
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $comment = Comment::findOrFail($id);

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $comment->update($validated);
        return response()->json($comment);
    }

    // DELETE /api/comments/{id}
    public function delete($id): \Illuminate\Http\JsonResponse
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Comment deleted']);
    }
}
