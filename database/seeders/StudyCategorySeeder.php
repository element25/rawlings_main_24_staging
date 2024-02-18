<?php

namespace Database\Seeders;

use App\Models\StudyCategory;
use Illuminate\Database\Seeder;

class StudyCategorySeeder extends Seeder
{
    public function run(): void
    {
        StudyCategory::create([
            'name' => 'New product development',
            'short_name' => 'NPD',
            'colour' => 'text-rawl-purple',
        ]);
        StudyCategory::create([
            'name' => 'Bespoke glass',
            'short_name' => 'Bespoke glass',
            'colour' => 'text-teal-700',
        ]);
        StudyCategory::create([
            'name' => 'Bespoke labels',
            'short_name' => 'Bespoke labels',
            'colour' => 'text-rawl-blue',
        ]);
        StudyCategory::create([
            'name' => 'Logo designs',
            'short_name' => 'Logo designs',
            'colour' => 'text-rawl-blue',
        ]);
        StudyCategory::create([
            'name' => 'Label design',
            'short_name' => 'Label design',
            'colour' => 'text-rawl-blue',
        ]);
    }
}
