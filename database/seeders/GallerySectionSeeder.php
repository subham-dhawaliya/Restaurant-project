<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GallerySectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $galleryItems = [
            [
                'title' => 'Delicious Pasta',
                'description' => 'Fresh homemade pasta with authentic Italian sauce',
                'category' => 'Food',
                'order' => 1,
                'is_active' => true
            ],
            [
                'title' => 'Grilled Steak',
                'description' => 'Premium quality steak grilled to perfection',
                'category' => 'Food',
                'order' => 2,
                'is_active' => true
            ],
            [
                'title' => 'Restaurant Interior',
                'description' => 'Cozy and elegant dining atmosphere',
                'category' => 'Interior',
                'order' => 3,
                'is_active' => true
            ],
            [
                'title' => 'Fresh Salad',
                'description' => 'Healthy and colorful garden salad',
                'category' => 'Food',
                'order' => 4,
                'is_active' => true
            ],
            [
                'title' => 'Birthday Celebration',
                'description' => 'Special moments with family and friends',
                'category' => 'Events',
                'order' => 5,
                'is_active' => true
            ],
            [
                'title' => 'Chef at Work',
                'description' => 'Our talented chefs preparing delicious meals',
                'category' => 'Behind the Scenes',
                'order' => 6,
                'is_active' => true
            ]
        ];

        foreach ($galleryItems as $item) {
            // Note: You'll need to add actual images later
            // For now, we're creating entries without images
            // Admin can upload images through the dashboard
            \App\Models\GallerySection::create($item);
        }
    }
}
