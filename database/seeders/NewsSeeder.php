<?php

namespace Database\Seeders;

use App\Enums\NewsStatus;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Seeder;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        //
        //        NewsCategory::insert(['name' => 'General', 'icon' => 'heroicon-o-newspaper']);
        //        NewsCategory::insert(['name' => 'Insights', 'icon' => 'heroicon-o-eye']);
        //        NewsCategory::insert(['name' => 'Inspiration', 'icon' => 'heroicon-o-heart']);
        //        NewsCategory::insert(['name' => 'Products', 'icon' => 'heroicon-o-cube']);

        //        $categories = NewsCategory::all()->pluck('id');
        //        ray($categories);

        $article = News::factory()->createQuietly([
            'title' => 'Rawlings Group has welcomed another market leading brand to the business.',
            'summary' => 'Willys ACV',
            'content' => null,
            'slug' => 'rawlings-group-has-welcomed-another-market-leading-brand-to-the-business',
            'html_title' => 'Rawlings Group has welcomed another market leading brand to the business.',
            'meta_desc' => 'Rawlings Group has welcomed another market leading brand to the business.',
            'related_1' => rand(2, 10),
            'related_2' => rand(2, 10),
            'status' => NewsStatus::PUBLISHED,
            'published_at' => '2023-10-17',
            'version' => 2024,
            'user_id' => 1,
        ]);

        //        $article->categories()->attach($categories->random(3));
        $this->saveImage($article, 'seeddata/news/hero.jpg', 'news_hero');

        News::factory(10)->createQuietly();
        News::factory(3)->draft()->createQuietly();
        News::factory(3)->scheduled()->createQuietly();
        News::factory(3)->unpublished()->createQuietly();

        $studies = News::all(); //whereNot('id', $article->id)->get();
        $studies->each(function (News $article_each, int $key) use ($article) {
            $logos = ['ar', 'week', 'vigo', 'hurricane'];
            $logo = $logos[array_rand($logos)];
            if ($article_each->id == $article->id) {
                $logo = 'bags';
            }
            $this->saveImage($article_each, 'seeddata/news/'.$logo.'.jpg', 'news_index');
            //            $categories_inside = $categories;
            $categories_inside = NewsCategory::all()->pluck('id');
            $category_1 = $categories_inside->pull($categories_inside->random() - 1);
            $category_2 = $categories_inside->pull($categories_inside->random() - 1);
            $category_3 = $categories_inside->pull($categories_inside->random() - 1);
            $article_each->categories()->attach([$category_1, $category_2, $category_3]);
            $article_each->order_column = $article_each->id;
            $article_each->save();
        });
    }

    protected function saveImage($article2, $image_path, $collection)
    {
        $article2
            ->addMedia(storage_path($image_path))
            ->withResponsiveImages()
            ->preservingOriginal()
//            ->toMediaCollection($collection, 'local_filament_image_uploads');
            ->toMediaCollection($collection);

        if ($collection == 'news_index') {
            $article2->logo_html = $article2->getFirstMedia('news_index')->toHtml();
            $article2->save();
        }
    }
}
