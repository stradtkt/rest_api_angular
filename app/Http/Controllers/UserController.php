<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Services\NotificationService;
class UserController extends Controller
{
    // GET /api/users
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json(User::all());
    }

    // GET /api/users/{id}
    public function show($id): \Illuminate\Http\JsonResponse
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // POST /api/users
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user, 201);
    }

    // PUT /api/users/{id}
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'sometimes|required|string|max:255',
            'email'    => 'sometimes|required|string|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user->name = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json($user);
    }

    // DELETE /api/users/{id}
    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted']);
    }
    public function countUsers()
    {
        $count = User::count();
        return response()->json($count);
    }

    // GET /api/users/{id}/welcome
    public function welcome($id): \Illuminate\Http\JsonResponse
    {
        $user = User::findOrFail($id);
        $notifier = new NotificationService();
        $message = $notifier->sendWelcomeMessage($user);

        return response()->json(['message' => $message]);
    }

    // POST /api/register
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        return $this->store($request); // reuse store method
    }

    // POST /api/login
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['Invalid credentials.'],
            ]);
        }

        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'user'  => $user,
            'token' => $token,
        ]);
    }

    // POST /api/logout
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out']);
    }

    public function availableFriends($currentUserId)
    {
        $friends = \App\Models\Friendship::where(function ($q) use ($currentUserId) {
            $q->where('sender_id', $currentUserId)
                ->orWhere('receiver_id', $currentUserId);
        })->pluck('sender_id', 'receiver_id')->flatten();

        return \App\Models\User::where('id', '!=', $currentUserId)
            ->whereNotIn('id', $friends)
            ->get();
    }
}
