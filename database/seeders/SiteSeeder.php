<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Site;

class SiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Site::create([
            'app_title'=>'Shop Management System',
            'company_name' => 'Smart Technology',
            'company_email' => 'smarttechnology@gmail.com',
            'company_phone' => '01234567890',
        ]);
    }
}
