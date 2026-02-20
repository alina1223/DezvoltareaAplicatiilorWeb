<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\ServiceCategory;

class ServiceSeeder extends Seeder
{
    
    public function run(): void
    {
       
        if (Service::count() > 0) {
            return;
        }

        $webCategory = ServiceCategory::where('slug', 'web-development')->first();
        $mobileCategory = ServiceCategory::where('slug', 'mobile-development')->first();
        $designCategory = ServiceCategory::where('slug', 'design')->first();

        if ($webCategory) {
            Service::create([
                'title' => 'Website Development',
                'description' => 'Crearea unui website modern cu Laravel',
                'price' => 1500.00,
                'category_id' => $webCategory->id,
                'is_active' => true
            ]);

            Service::create([
                'title' => 'E-commerce Platform',
                'description' => 'Platform de e-commerce completa cu plati online',
                'price' => 3500.00,
                'category_id' => $webCategory->id,
                'is_active' => true
            ]);
        }

        if ($mobileCategory) {
            Service::create([
                'title' => 'Android App Development',
                'description' => 'Aplicatie Android nativa',
                'price' => 2500.00,
                'category_id' => $mobileCategory->id,
                'is_active' => true
            ]);

            Service::create([
                'title' => 'iOS App Development',
                'description' => 'Aplicatie iOS nativa',
                'price' => 2800.00,
                'category_id' => $mobileCategory->id,
                'is_active' => true
            ]);
        }

        if ($designCategory) {
            Service::create([
                'title' => 'UI/UX Design',
                'description' => 'Design interfata si experienta utilizator',
                'price' => 800.00,
                'category_id' => $designCategory->id,
                'is_active' => true
            ]);
        }
    }
}
