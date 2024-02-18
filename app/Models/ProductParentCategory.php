<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class ProductParentCategory extends Model
{
    //    use Sushi;

    protected $guarded = [];

    protected $table = 'product_parent_categories';

    protected static function booted(): void
    {
        static::updated(function () {
            Cache::rememberForever('layout.navigation.product_categories', function () {
                return ProductParentCategory::getAllProductParentAndSubcategories();
            });
        });
    }

    public static function getAllProductParentAndSubcategories()
    {
        return ProductParentCategory::query()
            ->with(['subCategories' => function (Builder $query) {
                $query->whereActive(1)->orderBy('order_column');
            }])
            ->whereActive(1)
            ->orderBy('order_column')
            ->get();
    }

    public function subCategories(): HasMany
    {
        return $this->hasMany(ProductCategory::class, 'parent_id');
    }
}
