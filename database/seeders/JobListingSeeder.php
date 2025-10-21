<?php

namespace Database\Seeders;

use App\Models\JobListing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $listings = JobListing::factory(20)->create();

        for ($i = 0; $i < 2; $i++) {
            $listings[$i]->update(['is_featured' => true]);
        }
    }
}
