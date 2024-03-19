<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Define Arabic car electrical service names
        $services = [
            'تشخيص مشاكل الكهرباء',
            'صيانة البطارية',
            'تركيب أنظمة الإنارة',
            'إصلاح الدوائر الكهربائية',
            'تركيب أنظمة الصوت والمرئيات',
            'تركيب أنظمة الأمان',
            'تركيب أنظمة الإنذار',
            'صيانة بوكس الفيوزات',
            'صيانة الدينامو',
            'صيانة السلف',
            'صيانة الأسلاك الكهربائية',
        ];

        // Insert services into the database
        foreach ($services as $serviceName) {
            Service::create([
                'name' => $serviceName,
                'description' => 'وصف للخدمة هنا',
                'price' => rand(50, 200), // Random price between 50 and 200
            ]);
        }
    }
}
