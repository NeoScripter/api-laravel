<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'tags' => 'nullable|array',
            'tags.*' => 'string|exists:tags,name'
        ]);

        $tags = $validated['tags'] ?? [];

        if (empty($tags)) {
            $jobs = JobListing::with('tags')->get();

            return response()->json([
                'jobs' => $jobs
            ], 200);
        }

        $jobs = JobListing::with('tags')
            ->whereHas('tags', fn($tag) => $tag->whereIn('name',  $tags))
            ->get();

        return response()->json([
            'jobs' => $jobs
        ], 200);
    }
}
