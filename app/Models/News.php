<?php

namespace App\Models;

use App\Enums\NewsStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryItem;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class News extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'status' => NewsStatus::class,
        'content' => 'array',
    ];

    protected static function booted(): void
    {
        static::created(function (News $article) {
            //https://github.com/spatie/laravel-medialibrary/discussions/1817
            if ($article->getFirstMedia('news_index')) {
                $article->logo_html = $article->getFirstMedia('news_index')->toHtml();
                $article->save();

            }
        });
    }

    public function getImageIndexResponsiveAttribute()
    {
        $mediaLibraryItem = MediaLibraryItem::find($this->image_index);

        $spatieMediaModel = $mediaLibraryItem->getFirstMedia();

        return $spatieMediaModel;
    }

    public function getImageHeroResponsiveAttribute()
    {
        $mediaLibraryItem = MediaLibraryItem::find($this->image_hero);

        $spatieMediaModel = $mediaLibraryItem->getItem();
        //        ray($spatieMediaModel);

        return $spatieMediaModel;
    }

    public function imageHero(): BelongsTo
    {
        $image_hero = $this->belongsTo(MediaLibraryItem::class, 'image_hero', 'id');
        ray($image_hero);

        return $image_hero;
    }

    public function getNiceDateAttribute()
    {
        $nice_date = Carbon::parse($this->published_at)->format('F jS, Y');

        return $nice_date;
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(NewsCategory::class, 'news_category', 'news_id', 'category_id');
    }

    public function related(): Collection
    {
        return News::with('categories')->whereIn('id', [$this->related_1, $this->related_2])->get();
    }

    //    public function registerMediaConversions(?\Spatie\MediaLibrary\MediaCollections\Models\Media $media = null): void
    //    {
    //        $this->addMediaConversion('hero')
    //            ->performOnCollections('news_hero')
    //            ->width(1536)
    //            ->withResponsiveImages();
    //
    //        $this->addMediaConversion('index')
    //            ->performOnCollections('news_index')
    //            ->width(459)
    //            ->height(459)
    //            ->withResponsiveImages();
    //    }
}
