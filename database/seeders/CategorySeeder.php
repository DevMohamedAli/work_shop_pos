<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert categories into the database
        Category::create([
            'name' => 'قطع غيار',
            'description' => 'قطع غيار السيارات كهرابائية وميكانيكية',
            'image' => 'spareparts.png', // Assuming you have an image named 'category1.jpg' in the storage
        ]);

        Category::create([
            'name' => 'كاماليات',
            'description' => 'كماليات سيارات مثل مسحل ومكيف ومسجل',
            'image' => 'accessories.png', // Assuming you have an image named 'category2.jpg' in the storage
        ]);
    }
}
