<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $clients = Clients::with(['user', 'jobs'])->get();
        return response()->json($clients);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:50',
            'company_name'  => 'nullable|string|max:255',
            'industry'      => 'nullable|string|max:255',
            'address'       => 'nullable|string|max:255',
            'city'          => 'nullable|string|max:255',
            'state'         => 'nullable|string|max:255',
            'postal_code'   => 'nullable|string|max:20',
            'country'       => 'nullable|string|max:100',
            'notes'         => 'nullable|string'
        ]);

        $client = Clients::create($validated);
        return response()->json($client, 201);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $client = Clients::with(['user', 'jobs'])->findOrFail($id);
        return response()->json($client);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $client = Clients::findOrFail($id);

        $validated = $request->validate([
            'user_id'       => 'sometimes|exists:users,id',
            'name'          => 'sometimes|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:50',
            'company_name'  => 'nullable|string|max:255',
            'industry'      => 'nullable|string|max:255',
            'address'       => 'nullable|string|max:255',
            'city'          => 'nullable|string|max:255',
            'state'         => 'nullable|string|max:255',
            'postal_code'   => 'nullable|string|max:20',
            'country'       => 'nullable|string|max:100',
            'notes'         => 'nullable|string'
        ]);

        $client->update($validated);
        return response()->json($client);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $client = Clients::findOrFail($id);
        $client->delete();
        return response()->json(['message' => 'Client deleted successfully']);
    }
}
