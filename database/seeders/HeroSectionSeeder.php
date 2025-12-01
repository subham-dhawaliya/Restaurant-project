<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\HeroSection::create([
            'title' => "Enjoy Your Healthy\nDelicious Food",
            'description' => 'We are team of talented chefs making delicious food with passion',
            'button_text' => 'Book a Table',
            'button_link' => '#book-a-table',
            'video_text' => 'Watch Video',
            'video_link' => 'https://www.youtube.com/watch?v=Y7f98aduVJ8',
            'is_active' => true
        ]);
    }
}
