<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ProductCategory extends Model
{
    //    use Sushi;

    protected $guarded = [];

    protected $table = 'product_categories';

    //    public $timestamps = false;

    //    protected $rows = [
    //        ['id' => 1, 'label' => 'General', 'icon' => 'heroicon-o-newspaper'],
    //        ['id' => 2, 'label' => 'Insights', 'icon' => 'heroicon-o-eye'],
    //        ['id' => 3, 'label' => 'Inspiration', 'icon' => 'heroicon-o-heart'],
    //        ['id' => 4, 'label' => 'Products', 'icon' => 'heroicon-o-cube'],
    //    ];

    public function products(): BelongsToMany
    {
        return $this->BelongsToMany(Product::class);
    }

    public function parentCategory(): hasOne
    {
        return $this->hasOne(ProductParentCategory::class);
    }

    //    protected function newRelatedInstance($class)
    //    {
    //        return tap(new $class, function ($instance) use ($class) {
    //            if (! $instance->getConnectionName()) {
    //                $instance->setConnection($this->getConnectionResolver()->getDefaultConnection());
    //                parent::newRelatedInstance($class);
    //            }
    //        });
    //    }
}
