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

        $jobs = JobListing::when(
            !empty($tags),
            fn($q) => $q->whereHas('tags', fn($tag) => $tag->whereIn('name', $tags))
        )->orderBy('is_featured', 'desc')->get();

        return response()->json($jobs);
    }
}
