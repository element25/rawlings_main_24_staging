<?php

namespace App\View\Components\Partials\Layout;

use App\Models\ProductParentCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class ProductsNav extends Component
{
    public function __construct(public $categories)
    {
    }

    public function render(): View|Closure|string
    {
        $this->categories = Cache::rememberForever('layout.navigation.product_categories', function () {
            return ProductParentCategory::getAllProductParentAndSubcategories();
        });
        //        $this->categories =
        ray(Cache::get('layout.navigation.product_categories'));

        return view('components.partials.layout.products_nav');
    }
}
