<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class StudyCategory extends Model implements Sortable
{
    use HasFactory;
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    protected $guarded = [];

    protected $table = 'study_categories';

    public function studies(): BelongsToMany
    {
        return $this->belongsToMany(Study::class, 'study_category', 'category_id', 'study_id');
    }

    //    public function forAlpine()
    //    {
    //        return [
    //            $this->id => [
    //                'id' => $this->id,
    //                'name' => $this->name,
    //            ],
    //        ];
    //    }
}
