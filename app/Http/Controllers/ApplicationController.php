<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function store(Request $request, Job $job): JsonResponse
    {
        $request->validate([
            'cover_letter' => ['nullable', 'string'],
        ]);

        $existing = Application::where('user_id', $request->user()->id)
            ->where('job_id', $job->id)
            ->first();

        if ($existing !== null) {
            return response()->json(['message' => 'Already applied'], 422);
        }

        $application = Application::create([
            'user_id'      => $request->user()->id,
            'job_id'       => $job->id,
            'cover_letter' => $request->input('cover_letter'),
            'status'       => 'pending',
        ]);

        return response()->json($application, 201);
    }

    public function index(Request $request): JsonResponse
    {
        $applications = Application::with(['user', 'job'])
            ->latest()
            ->get();

        return response()->json($applications);
    }

    public function update(Request $request, Application $application): JsonResponse
    {
        $request->validate([
            'status' => ['required', 'in:approved,rejected'],
        ]);

        $application->update(['status' => $request->input('status')]);

        return response()->json($application);
    }
}