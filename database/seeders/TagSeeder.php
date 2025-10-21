<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = ['Fullstack', 'Frontend', 'Senior', 'HTML', 'CSS', 'JavaScript', 'React', 'Python'];

        foreach ($names as $name) {
            Tag::create(['name' => $name]);
        }
    }
}
