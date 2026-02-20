<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ServiceCategory;

class ServiceCategorySeeder extends Seeder
{

    public function run(): void
    {
        
        ServiceCategory::firstOrCreate(
            ['slug' => 'web-development'],
            [
                'name' => 'Web Development',
                'description' => 'Servicii de dezvoltare web',
                'display_order' => 1
            ]
        );

        ServiceCategory::firstOrCreate(
            ['slug' => 'mobile-development'],
            [
                'name' => 'Mobile Development',
                'description' => 'Aplicatii mobile native si cross-platform',
                'display_order' => 2
            ]
        );

        ServiceCategory::firstOrCreate(
            ['slug' => 'design'],
            [
                'name' => 'Design',
                'description' => 'Servicii de design UI/UX',
                'display_order' => 3
            ]
        );
    }
}
