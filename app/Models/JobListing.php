<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class JobListing extends Model
{
    /** @use HasFactory<\Database\Factories\JobListingFactory> */
    use HasFactory;

    protected $appends = ['created_at_human', 'tag_names'];
    protected $hidden = ['created_at', 'updated_at'];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getTagNamesAttribute()
    {
        return $this->tags->pluck('name')->values();
    }

    public function getCreatedAtHumanAttribute()
    {
        return $this->created_at
            ? Carbon::parse($this->created_at)->diffForHumans()
            : null;
    }
}
