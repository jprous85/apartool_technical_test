<?php

namespace Database\Seeders;

use App\Models\Apartment;
use Illuminate\Database\Seeder;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = [
            [
                'category_id' => 1,
                'name' => 'apartment 1',
                'description' => 'description apartment 1',
                'quantity' => 1,
                'active' => 1,
            ],
            [
                'category_id' => 2,
                'name' => 'apartment 2',
                'description' => 'description apartment 2',
                'quantity' => 2,
                'active' => 1,
            ],
            [
                'category_id' => 3,
                'name' => 'apartment 3',
                'description' => 'description apartment 3',
                'quantity' => 3,
                'active' => 1,
            ],
        ];

        foreach ($apartments as $apartment) {
            Apartment::create($apartment);
        }
    }
}
