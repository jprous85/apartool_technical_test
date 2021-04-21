<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'name' => 'Luxury',
                'description' => 'Luxury apartment'
            ],
            [
                'name' => 'Standard',
                'description' => 'Standard apartment'
            ],
            [
                'name' => 'Regular',
                'description' => 'Regular apartment'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
