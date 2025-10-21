<?php

namespace Database\Factories;

use App\Models\JobListing;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Testing\Fakes\Fake;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobListing>
 */
class JobListingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'company_name' => fake()->company(),
            'logo_url' => asset('storage/job_listings/' . fake()->numberBetween(0, 7) . '.svg'),
            'employment_type' => fake()->randomElement(['Full time', 'Part time', 'Freelance', 'Contract']),
            'location_type' => fake()->randomElement(['Worldwide', 'USA only', 'UK only', 'Remote']),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (JobListing $listing) {
            $tagIds = Tag::inRandomOrder()->take(rand(2, 5))->pluck('id');
            $listing->tags()->attach($tagIds);
        });
    }
}
