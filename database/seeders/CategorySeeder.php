<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $categories = [
            ['name' => 'Electronics', 'description' => 'Devices and gadgets'],
            ['name' => 'Books', 'description' => 'Printed and digital books'],
            ['name' => 'Clothing', 'description' => 'Apparel and accessories'],
            ['name' => 'Home & Kitchen', 'description' => 'Household items and kitchenware'],
            ['name' => 'Sports & Outdoors', 'description' => 'Sporting goods and outdoor equipment'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
