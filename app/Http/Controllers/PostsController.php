<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with(['user', 'comments'])->get();
        return response()->json($posts);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id'   => 'required|exists:users,id',
            'title'     => 'required|string|max:255',
            'content'   => 'required|string',
        ]);
        $post = Post::create($validated);
        return response()->json($post, 201);
    }

    public function show($id)
    {
        $post = Post::with(['user', 'comments'])->findOrFail($id);
        return response()->json($post);
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $validated = $request->validate([
            'title'   => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);
        $post->update($validated);
        return response()->json($post);
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json(['message' => 'Post deleted successfully']);
    }

    public function countPosts()
    {
        $count = Post::count();
        return response()->json([$count]);
    }
}

