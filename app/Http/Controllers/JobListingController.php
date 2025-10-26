<?php

namespace App\Http\Controllers;

use App\Models\JobListing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class JobListingController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'tags' => 'nullable|array',
            'tags.*' => 'string|exists:tags,name'
        ]);

        $tags = $validated['tags'] ?? [];
        sort($tags);

        $jobs = Cache::flexible('job_listings_' . implode(',', $tags), [5 * 60, 10 * 60], function () use ($tags) {
            return JobListing::when(
                !empty($tags),
                fn($q) => $q->whereHas('tags', fn($tag) => $tag->whereIn('name', $tags))
            )->orderBy('is_featured', 'desc')->get();
        });

        return response()->json($jobs);
    }
}
