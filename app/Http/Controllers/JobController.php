<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(): JsonResponse
    {
        $jobs = Job::open()->with('user')->latest()->get();

        return response()->json($jobs);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'company_name' => ['required', 'string', 'max:255'],
            'location'     => ['required', 'string'],
            'description'  => ['required', 'string'],
            'salary'       => ['nullable', 'numeric', 'min:0'],
        ]);

        $job = Job::create([
            'user_id'      => $request->user()->id,
            'title'        => $request->input('title'),
            'company_name' => $request->input('company_name'),
            'location'     => $request->input('location'),
            'description'  => $request->input('description'),
            'salary'       => $request->input('salary'),
            'status'       => 'open',
        ]);

        return response()->json($job, 201);
    }

    public function destroy(Request $request, Job $job): JsonResponse
    {
        if ($request->user()->id !== $job->user_id && !$request->user()->isAdmin()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $job->delete();

        return response()->json(null, 204);
    }
}