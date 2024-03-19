<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Customer::create([
            'name' => 'نقدي',
            'no_telp' => '0918326171',
            'address' => 'نقدي',
        ]);

        \App\Models\Employee::create([
            'name' => 'محمد',
            'specialization' => 'كهربائي',
            'phone' => '0918326171',
            'relatives_phone' => '0918326171',
            'blood_type' => 'A+',
            'address' => 'جنزور',
            'commission_rate' => 50,
        ]);





    }
}
