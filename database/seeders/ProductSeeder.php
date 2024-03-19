<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define Arabic Libyan spare parts names
        $spareParts = [
            [
                'name' => 'بطارية',
                'image' => 'storage\app\public\spareparts\battery.png',
            ],
            [
                'name' => 'فلتر هواء',
                'image' => 'storage\app\public\spareparts\air_filter.png',
            ],
            [
                'name' => 'باطني سيارة',
                'image' => 'storage\app\public\spareparts\Breakpad.png',
            ],
            // Add more spare parts as needed
        ];

        // Insert spare parts products into the database with category_id = 1
        foreach ($spareParts as $part) {
            Product::create([
                'category_id' => 1,
                'barcode' => 'SPAREPART-' . uniqid(),
                'image' => $part['image'],
                'title' => $part['name'], // Use $part['name'] as the title
                'description' => 'وصف للقطعة هنا',
                'buy_price' => rand(100, 500),
                'sell_price' => rand(200, 800),
                'stock' => rand(10, 50),
            ]);
        }
    }
}
