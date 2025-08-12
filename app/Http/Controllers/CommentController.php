<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::with(['post', 'user'])->get();
        return response()->json($comments);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'  => 'required|exists:users,id',
            'post_id'  => 'required|exists:posts,id',
            'content'  => 'required|string|max:1000',
        ]);

        $comment = Comment::create($validated);

        return response()->json($comment, 201);
    }

    public function show($id)
    {
        $comment = Comment::with(['post', 'user'])->findOrFail($id);
        return response()->json($comment);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::findOrFail($id);

        $validated = $request->validate([
            'content' => 'sometimes|string|max:1000',
        ]);

        $comment->update($validated);

        return response()->json($comment);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }

    public function countComments() {
        $count = Comment::count();
        return response()->json([$count]);
    }
}
