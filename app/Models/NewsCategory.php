<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class NewsCategory extends Model
{
    protected $guarded = [];

    protected $table = 'news_categories';

    public function articles(): BelongsToMany
    {
        return $this->BelongsToMany(News::class);
    }
}
