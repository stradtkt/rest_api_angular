<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{
    // Assign roles to a user
    public function assignRoles(Request $request, $userId)
    {
        $request->validate([
            'role_ids' => 'required|array',
            'role_ids.*' => 'exists:roles,id',
        ]);

        $user = User::findOrFail($userId);
        $user->roles()->sync($request->role_ids); // Replace existing roles

        return response()->json([
            'message' => 'Roles assigned successfully.',
            'roles' => $user->roles
        ]);
    }

    // Get roles of a user
    public function getUserRoles($userId)
    {
        $user = User::findOrFail($userId);
        return response()->json($user->roles);
    }

    // Remove a specific role from a user
    public function detachRole($userId, $roleId)
    {
        $user = User::findOrFail($userId);
        $user->roles()->detach($roleId);

        return response()->json(['message' => 'Role removed from user.']);
    }
}

