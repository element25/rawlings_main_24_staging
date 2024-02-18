<?php

namespace App\Console\Commands\Migrate;

use App\Models\ProductCategory;
use App\Models\ProductParentCategory;
use Illuminate\Console\Command;

class MigrateCategories extends Command
{
    protected $signature = 'migrate:categories';

    protected $description = 'Migrate products and create categories';

    public function handle(): void
    {
        //        DB::table('products_parent_category')->truncate();
        //        DB::table('products_category')->truncate();
        ProductParentCategory::truncate();
        ProductCategory::truncate();

        $beer = ProductParentCategory::create([
            'name' => 'Beers & Ciders', 'slug' => 'beer-and-cider-bottles', 'order_column' => 1,
        ]);
        ProductCategory::create(['name' => 'Amber Bottles', 'slug' => 'amber-bottles', 'parent_id' => $beer->id, 'order_column' => 1]);
        ProductCategory::create(['name' => 'Clear W/F Bottles', 'slug' => 'clear-white-flint-bottles', 'parent_id' => $beer->id, 'order_column' => 2]);
        ProductCategory::create(['name' => 'Green Bottles', 'slug' => 'green-bottles', 'parent_id' => $beer->id, 'order_column' => 3]);
        ProductCategory::create(['name' => 'Swing Top Bottles', 'slug' => 'swing-top-bottles', 'parent_id' => $beer->id, 'order_column' => 4]);

        $spirit = ProductParentCategory::create([
            'name' => 'Spirits', 'slug' => 'spirits-bottles', 'order_column' => 2,
        ]);
        ProductCategory::create(['name' => 'Standard Range', 'slug' => 'standard-range', 'parent_id' => $spirit->id, 'order_column' => 1]);
        ProductCategory::create(['name' => 'Premium', 'slug' => 'premium', 'parent_id' => $spirit->id, 'order_column' => 2]);
        ProductCategory::create(['name' => 'Miniatures', 'slug' => 'miniatures', 'parent_id' => $spirit->id, 'order_column' => 3]);
        ProductCategory::create(['name' => 'Pre-mixed Cocktails', 'slug' => 'pre-mixed-cocktails', 'parent_id' => $spirit->id, 'order_column' => 4]);

        $wine = ProductParentCategory::create([
            'name' => 'Wine & Champagne', 'slug' => 'wine-bottles', 'order_column' => 3,
        ]);
        ProductCategory::create(['name' => 'Bordeaux', 'slug' => 'bordeaux', 'parent_id' => $wine->id, 'order_column' => 1]);
        ProductCategory::create(['name' => 'Burgundy', 'slug' => 'burgundy', 'parent_id' => $wine->id, 'order_column' => 2]);
        ProductCategory::create(['name' => 'Green Bottles', 'slug' => 'green-bottles', 'parent_id' => $wine->id, 'order_column' => 3]);
        ProductCategory::create(['name' => 'Champagne', 'slug' => 'champagne', 'parent_id' => $wine->id, 'order_column' => 4]);

        $soft = ProductParentCategory::create([
            'name' => 'Soft Drinks', 'slug' => 'soft-drinks', 'order_column' => 4,
            'class' => '2xl:pl-2',
        ]);
        ProductCategory::create(['name' => 'Mineral Water Bottles', 'slug' => 'mineral-water-bottles', 'parent_id' => $soft->id, 'order_column' => 1]);
        ProductCategory::create(['name' => 'Mixer Bottles', 'slug' => 'mixer-bottles', 'parent_id' => $soft->id, 'order_column' => 2]);
        ProductCategory::create(['name' => 'Juice Bottles', 'slug' => 'juice-bottles', 'parent_id' => $soft->id, 'order_column' => 3]);
        ProductCategory::create(['name' => 'Dairy Bottles', 'slug' => 'dairy-bottles', 'parent_id' => $soft->id, 'order_column' => 4]);
        ProductCategory::create(['name' => 'Kombucha Bottles', 'slug' => 'kombucha-bottles', 'parent_id' => $soft->id, 'order_column' => 5]);
        ProductCategory::create(['name' => 'Aluminium Cans', 'slug' => 'aluminium-cans', 'parent_id' => $soft->id, 'order_column' => 6]);

        $food = ProductParentCategory::create([
            'name' => 'Food', 'slug' => 'foods', 'order_column' => 5,
            'class' => 'xl:pl-2',
        ]);
        ProductCategory::create(['name' => 'Mini Jars', 'slug' => 'mini-jars', 'parent_id' => $food->id, 'order_column' => 1]);
        ProductCategory::create(['name' => 'Jam Jars', 'slug' => 'jam-jars', 'parent_id' => $food->id, 'order_column' => 2]);
        ProductCategory::create(['name' => 'Honey Jars', 'slug' => 'honey-jars', 'parent_id' => $food->id, 'order_column' => 3]);
        ProductCategory::create(['name' => 'Pickling Jars', 'slug' => 'pickling-jars', 'parent_id' => $food->id, 'order_column' => 4]);
        ProductCategory::create(['name' => 'Le Parfait Clip Jars', 'slug' => 'le-parfait-clip-jars', 'parent_id' => $food->id, 'order_column' => 5]);
        ProductCategory::create(['name' => 'Wedding Favours', 'slug' => 'wedding-favours', 'parent_id' => $food->id, 'order_column' => 6]);
        ProductCategory::create(['name' => 'Sauce Bottles', 'slug' => 'sauce-bottles', 'parent_id' => $food->id, 'order_column' => 7]);
        ProductCategory::create(['name' => 'Oil Bottles', 'slug' => 'oil-bottles', 'parent_id' => $food->id, 'order_column' => 8]);
        ProductCategory::create(['name' => 'Round Jars', 'slug' => 'round-jars', 'parent_id' => $food->id, 'order_column' => 9]);
        ProductCategory::create(['name' => 'Hexagonal Jars', 'slug' => 'hexagonal-jars', 'parent_id' => $food->id, 'order_column' => 10]);
        ProductCategory::create(['name' => 'Square Jars', 'slug' => 'square-jars', 'parent_id' => $food->id, 'order_column' => 11]);

        $health = ProductParentCategory::create([
            'name' => 'Health & Beauty', 'slug' => 'health-and-beauty', 'order_column' => 6,
        ]);
        ProductCategory::create(['name' => 'Powder & Tablet Jars', 'slug' => 'powder-and-tablet-jars', 'parent_id' => $health->id, 'order_column' => 1]);
        ProductCategory::create(['name' => 'Squat & Ointment Jars', 'slug' => 'squat-and-ointment-jars', 'parent_id' => $health->id, 'order_column' => 2]);
        ProductCategory::create(['name' => 'Medical Bottles', 'slug' => 'medical-bottles', 'parent_id' => $health->id, 'order_column' => 3]);
        ProductCategory::create(['name' => 'Dropper Bottles', 'slug' => 'dropper-bottles', 'parent_id' => $health->id, 'order_column' => 4]);
        ProductCategory::create(['name' => 'Perfume & Fragrance Bottles', 'slug' => 'perfume-and-fragrance-bottles', 'parent_id' => $health->id, 'order_column' => 5]);
        ProductCategory::create(['name' => 'Vitamins & Supplements', 'slug' => 'vitamins-and-supplements', 'parent_id' => $health->id, 'order_column' => 6]);
        ProductCategory::create(['name' => 'Wellness Shot Bottles', 'slug' => 'wellness-shot-bottles', 'parent_id' => $health->id, 'order_column' => 7]);

        $candles = ProductParentCategory::create([
            'name' => 'Candles & Diffusers', 'slug' => 'candles-and-diffusers', 'order_column' => 7,
            'class' => 'grow xl:pl-6 2xl:pl-0',
        ]);
        ProductCategory::create(['name' => 'Candle Jars', 'slug' => 'candle-jars', 'parent_id' => $candles->id, 'order_column' => 1]);
        ProductCategory::create(['name' => 'Diffusers & Home Fragrance', 'slug' => 'diffusers-and-home-fragrance', 'parent_id' => $candles->id, 'order_column' => 2]);

        $closures = ProductParentCategory::create([
            'name' => 'Closures', 'slug' => 'closures-and-pumps', 'order_column' => 8,
            'class' => 'xl:pl-6 2xl:pl-8',
        ]);
        ProductCategory::create(['name' => 'Twist-off Lids', 'slug' => 'twist-off-lids', 'parent_id' => $closures->id, 'order_column' => 1]);
        ProductCategory::create(['name' => 'Beer Bottle Crowns', 'slug' => 'beer-bottle-crowns', 'parent_id' => $closures->id, 'order_column' => 2]);
        ProductCategory::create(['name' => 'Spirit Closures', 'slug' => 'spirit-closures', 'parent_id' => $closures->id, 'order_column' => 3]);
        ProductCategory::create(['name' => 'ROPP', 'slug' => 'ropp', 'parent_id' => $closures->id, 'order_column' => 4]);
        ProductCategory::create(['name' => 'Pourers', 'slug' => 'pourers', 'parent_id' => $closures->id, 'order_column' => 5]);
        ProductCategory::create(['name' => 'Corks', 'slug' => 'corks', 'parent_id' => $closures->id, 'order_column' => 6]);
        ProductCategory::create(['name' => 'Swing Tops', 'slug' => 'swing-tops', 'parent_id' => $closures->id, 'order_column' => 7]);

    }
}
