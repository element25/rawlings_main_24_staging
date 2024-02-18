<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::query()
            ->first();

        //        ray(json_decode($categories_json));

        //        $mediaLibraryItem = MediaLibraryItem::find(30);

        //        ray($mediaLibraryItem);

        //        $spatieMediaModel = $mediaLibraryItem->getFirstMedia();

        //        ray($spatieMediaModel);

        //        $categories = ProductParentCategory::query()
        //            ->with(['subCategories' => function (Builder $query) {
        //                $query->orderBy('order_column');
        //            }])
        //            ->orderBy('order_column')
        //            ->get();
        //        ray($categories);

        //return view('content.products.index', compact('product', 'spatieMediaModel'));
        //        return view('content.products.index', compact('categories'));
        return view('content.products.index');

    }
}
