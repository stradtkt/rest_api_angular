<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(): \Illuminate\Http\JsonResponse
    {
        $jobs = Jobs::with(['user', 'client'])->get();
        return response()->json($jobs);
    }

    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validated = $request->validate([
            'user_id'       => 'required|exists:users,id',
            'client_id'     => 'required|exists:clients,id',
            'title'         => 'required|string|max:255',
            'status'        => 'nullable|string|in:pending,in_progress,completed',
            'start_date'    => 'nullable|date',
            'due_date'      => 'nullable|date',
            'budget'        => 'nullable|numeric',
            'amount_spent'  => 'nullable|numeric',
            'priority'      => 'nullable|string|in:low,medium,high',
            'location'      => 'nullable|string|max:255',
            'description'   => 'nullable|string'
        ]);

        $job = Jobs::create($validated);
        return response()->json($job, 201);
    }

    public function show($id): \Illuminate\Http\JsonResponse
    {
        $job = Jobs::with(['user', 'client'])->findOrFail($id);
        return response()->json($job);
    }

    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $job = Jobs::findOrFail($id);

        $validated = $request->validate([
            'user_id'       => 'sometimes|exists:users,id',
            'client_id'     => 'sometimes|exists:clients,id',
            'title'         => 'sometimes|string|max:255',
            'status'        => 'nullable|string|in:pending,in_progress,completed',
            'start_date'    => 'nullable|date',
            'due_date'      => 'nullable|date',
            'budget'        => 'nullable|numeric',
            'amount_spent'  => 'nullable|numeric',
            'priority'      => 'nullable|string|in:low,medium,high',
            'location'      => 'nullable|string|max:255',
            'description'   => 'nullable|string'
        ]);

        $job->update($validated);
        return response()->json($job);
    }

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        $job = Jobs::findOrFail($id);
        $job->delete();
        return response()->json(['message' => 'Job deleted successfully']);
    }
}
