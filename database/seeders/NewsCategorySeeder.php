<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsCategorySeeder extends Seeder
{
    public function run(): void
    {
        NewsCategory::insert(['name' => 'General', 'icon' => 'heroicon-o-newspaper']);
        NewsCategory::insert(['name' => 'Insights', 'icon' => 'heroicon-o-eye']);
        NewsCategory::insert(['name' => 'Inspiration', 'icon' => 'heroicon-o-heart']);
        NewsCategory::insert(['name' => 'Products', 'icon' => 'heroicon-o-cube']);
    }
}
