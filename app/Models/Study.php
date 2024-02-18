<?php

namespace App\Models;

use App\Enums\StudyStatus;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Study extends Model implements HasMedia, Sortable
{
    use HasFactory;
    use InteractsWithMedia;
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];

    protected $guarded = [];

    //    protected $appends = ['logohtml'];

    protected $casts = [
        'status' => StudyStatus::class,
    ];

    //    protected $with = ['logo'];

    //    public function user()
    //    {
    //        return $this->belongsTo(User::class);
    //    }

    //    public function getLogohtmlAttribute()
    //    {
    //        //        $logo = $this->getFirstMedia('studies_our_work')->toHtml();
    //        $logo = $this->logo->toHtml();
    //
    //        return $logo;
    //    }
    //
    //    public function logo()
    //    {
    //        return $this->media()->where('collection_name', 'studies_our_work');
    //    }

    protected static function booted(): void
    {
        //        static::created(function (Study $study) {
        //            //https://github.com/spatie/laravel-medialibrary/discussions/1817
        //            $study->logo_html = $study->getFirstMedia('studies_our_work')->toHtml();
        //            $study->save();
        //        });
    }

    //    public function getLogoAttribute()
    //    {
    //        $logo = Media::where('model_id', $this->id)->where('collection_name', 'studies_our_work')->where('model_type', Study::class)->first();
    //        //        ray($logo);
    //
    //        //REMOVE WHEN USING LIVE DATA, ONLY NEEDED BECAUSE SOME LOGOS ARE MISSING
    //        if (! $logo) {
    //            $logo = Media::where('collection_name', 'studies_our_work')->where('model_type', Study::class)->first();
    //        }
    //
    //        return $logo;
    //    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(StudyCategory::class, 'study_category', 'study_id', 'category_id');
    }

    public function related(): Collection
    {
        return Study::with('categories')->whereIn('id', [$this->related_1, $this->related_2, $this->related_3])->get();
    }

    //    public function forAlpine()
    //    {
    //        return [
    //            $this->id => [
    //                'id' => $this->id,
    //                'title' => $this->title,
    //            ],
    //        ];
    //    }
    //
    //    protected function logo(): Attribute
    //    {
    //        return Attribute::make(
    //            get: function (string $value) {
    //
    //            }
    //        );
    //    }
}
