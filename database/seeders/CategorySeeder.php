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
                'title' => 'Luxury',
                'description' => 'Luxury apartment'
            ],
            [
                'title' => 'Standard',
                'description' => 'Standard apartment'
            ],
            [
                'title' => 'Regular',
                'description' => 'Regular apartment'
            ]
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
