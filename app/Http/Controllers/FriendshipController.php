<?php

namespace App\Http\Controllers;


use App\Models\Friendship;
use App\Services\FriendshipService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendshipController extends Controller
{
    public function sendRequest(Request $request)
    {
        $validated = $request->validate([
            'sender_id'   => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id|different:sender_id',
        ]);

        // Check if friendship already exists
        $exists = Friendship::whereRaw('
    (sender_id = ? AND receiver_id = ?) OR (sender_id = ? AND receiver_id = ?)',
            [$validated['sender_id'], $validated['receiver_id'], $validated['receiver_id'], $validated['sender_id']]
        )->exists();

        if ($exists) {
            return response()->json(['message' => 'Friend request already exists'], 400);
        }

        $friendship = Friendship::create($validated);

        return response()->json($friendship, 201);
    }

    public function acceptRequest($id)
    {
        $friendship = Friendship::findOrFail($id);
        $friendship->update(['status' => 'accepted']);
        return response()->json(['message' => 'Friend request accepted']);
    }

    public function denyRequest($id)
    {
        $friendship = Friendship::findOrFail($id);
        $friendship->update(['status' => 'denied']);
        return response()->json(['message' => 'Friend request denied']);
    }

    public function listFriends()
    {
        $userId = auth()->id();
        $friends = Friendship::where('status', 'accepted')
            ->where(function ($query) use ($userId) {
                $query->where('sender_id', $userId)
                    ->orWhere('receiver_id', $userId);
            })
            ->with(['sender', 'receiver'])
            ->get();
        $friendsList = $friends->map(function ($friendship) use ($userId) {
            return $friendship->sender_id == $userId
                ? $friendship->receiver
                : $friendship->sender;
        });

        return response()->json($friendsList);
    }

    // List pending requests for a user
    public function pendingRequests($userId)
    {
        $pending = Friendship::where('receiver_id', $userId)
            ->where('status', 'pending')
            ->with('sender')
            ->get();

        return response()->json($pending);
    }

    public function countPendingRequests() {
        $count = Friendship::where('receiver_id', auth()->id())
            ->where('status', 'pending')
            ->count();
        return response()->json(['count' => $count]);
    }
    public function countFriends() {
        $count = Friendship::where('status', 'accepted')
            ->where(function ($query) {
                $query->where('sender_id', auth()->id())
                    ->orWhere('receiver_id', auth()->id());
            });
        return response()->json(['count' => $count]);
    }

}
