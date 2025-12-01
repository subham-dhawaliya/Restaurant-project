<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenuSection;

class MenuSectionSeeder extends Seeder
{
    public function run(): void
    {
        $menuItems = [
            [
                'name' => 'Lobster Bisque',
                'description' => 'Lorem, deren, trataro, filede, nerada',
                'price' => 599.00,
                'category' => 'food',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Bread Barrel',
                'description' => 'Lorem, deren, trataro, filede, nerada',
                'price' => 149.00,
                'category' => 'food',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Crab Cake',
                'description' => 'A delicate crab cake served on a toasted roll with lettuce and tartar sauce',
                'price' => 799.00,
                'category' => 'food',
                'order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Caesar Selections',
                'description' => 'Lorem, deren, trataro, filede, nerada',
                'price' => 899.00,
                'category' => 'food',
                'order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Tuscan Grilled',
                'description' => 'Grilled chicken with provolone, artichoke hearts, and roasted red pesto',
                'price' => 999.00,
                'category' => 'food',
                'order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Mozzarella Stick',
                'description' => 'Lorem, deren, trataro, filede, nerada',
                'price' => 499.00,
                'category' => 'food',
                'order' => 6,
                'is_active' => true,
            ],
            [
                'name' => 'Greek Salad',
                'description' => 'Fresh spinach, crisp romaine, tomatoes, and Greek olives',
                'price' => 599.00,
                'category' => 'food',
                'order' => 7,
                'is_active' => true,
            ],
            [
                'name' => 'Spinach Salad',
                'description' => 'Fresh spinach with mushrooms, hard boiled egg, and warm bacon vinaigrette',
                'price' => 699.00,
                'category' => 'food',
                'order' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Lobster Roll',
                'description' => 'Plump lobster meat, mayo and crisp lettuce on a toasted bulky roll',
                'price' => 1299.00,
                'category' => 'food',
                'order' => 9,
                'is_active' => true,
            ],
            [
                'name' => 'Fresh Juice',
                'description' => 'Freshly squeezed orange juice',
                'price' => 99.00,
                'category' => 'beverages',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Coffee',
                'description' => 'Hot brewed coffee',
                'price' => 79.00,
                'category' => 'beverages',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Soft Drinks',
                'description' => 'Coke, Pepsi, Sprite, Fanta',
                'price' => 59.00,
                'category' => 'beverages',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($menuItems as $item) {
            MenuSection::create($item);
        }
    }
}
