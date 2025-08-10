<?php

namespace App\Http\Controllers;


use App\Models\Friendship;
use App\Services\FriendshipService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    // GET /api/friendships
    public function getAllFriendships()
    {
        return response()->json(Friendship::with(['sender', 'receiver'])->get());
    }

    // POST /api/friendships/send
    public function sendRequest(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id|different:' . Auth::id(),
        ]);

        $existing = Friendship::where([
            ['sender_id', Auth::id()],
            ['receiver_id', $request->receiver_id]
        ])->first();

        if ($existing) {
            return response()->json(['message' => 'Friend request already sent or exists.'], 400);
        }

        $friendship = Friendship::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'status' => 'pending'
        ]);

        return response()->json($friendship, 201);
    }

    // POST /api/friendships/respond
    public function respondToRequest(Request $request)
    {
        $request->validate([
            'friendship_id' => 'required|exists:friendships,id',
            'action' => 'required|in:accepted,declined'
        ]);

        $friendship = Friendship::findOrFail($request->friendship_id);

        if ($friendship->receiver_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $friendship->update(['status' => $request->action]);

        return response()->json(['message' => "Friend request {$request->action}"]);
    }

    // DELETE /api/friendships/{id}
    public function deleteFriendship($id)
    {
        $friendship = Friendship::findOrFail($id);

        if (Auth::id() !== $friendship->sender_id && Auth::id() !== $friendship->receiver_id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $friendship->delete();

        return response()->json(['message' => 'Friendship deleted']);
    }

    // GET /api/friendships/pending
    public function pendingRequests()
    {
        $pending = Friendship::where('receiver_id', Auth::id())
            ->where('status', 'pending')
            ->with('sender')
            ->get();

        return response()->json($pending);
    }

    // GET /api/friendships/friends
    public function getFriends(): JsonResponse
    {
        $friendshipService = new FriendshipService(Auth::id());
        return response()->json($friendshipService->getFriendsList());
    }

}
