<?php

namespace App\Console\Commands\Migrate;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryFolder;
use RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryItem;

class MigrateNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate news articles from old site';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        //        Schema::disableForeignKeyConstraints();
        //        MediaLibraryItem::truncate();
        //        MediaLibraryFolder::truncate();
        DB::table('news_category')->truncate();
        News::truncate();
        NewsCategory::truncate();
        //        Media::truncate();
        //        Schema::enableForeignKeyConstraints();

        NewsCategory::insert(['name' => 'General', 'slug' => 'general', 'icon' => 'heroicon-o-newspaper']);
        NewsCategory::insert(['name' => 'Insights', 'slug' => 'insights', 'icon' => 'heroicon-o-eye']);
        NewsCategory::insert(['name' => 'Inspiration', 'slug' => 'inspiration', 'icon' => 'heroicon-o-heart']);
        NewsCategory::insert(['name' => 'Products', 'slug' => 'products', 'icon' => 'heroicon-o-cube']);

        $news_folder = MediaLibraryFolder::create(['name' => 'News']);
        $news_index_folder = MediaLibraryFolder::create(['parent_id' => $news_folder->id, 'name' => 'Index']);
        $news_hero_folder = MediaLibraryFolder::create(['parent_id' => $news_folder->id, 'name' => 'Hero']);

        $news = DB::connection('mysql_main_production')->table('news')
            ->where('id', '>', 100)
            ->orderBy('created_at', 'asc')
            ->get();
        //ray($news);

        $order = 0;
        foreach ($news as $article_old) {
            $id = $article_old->id;
            $title = $article_old->title;
            $summary = $article_old->summary;
            $text = $article_old->text;
            $slug = $article_old->slug;
            $thumb_url = $article_old->thumb_url;
            $wide_url = $article_old->wide_url;
            $cats = $article_old->cats;
            $related = $article_old->related;
            $status = $article_old->status;
            $created_at = $article_old->created_at;
            $updated_at = $article_old->updated_at;
            $meta_title = $article_old->meta_title;
            $meta_desc = $article_old->meta_desc;

            //{"1": true, "2": false, "3": false, "4": false}
            $cats_array = [];
            //foreach (config('arrays.news_cats_names') as $key => $cat) {
            foreach (explode(',', $cats) as $cat) {
                $cats_array[] = $cat;
            }

            $related_1 = explode(',', $related)[0];
            $related_2 = explode(',', $related)[1];

            $related_random = $news->random(2)->pluck('id');
            //            ray($related_random);
            $related_1 = $related_random[0];
            $related_2 = $related_random[1];

            //$published_at = Carbon::parse($created_at)->toDateString();

            $article_new_data = [
                'id' => $id,
                'title' => $title,
                'summary' => $summary,
                'content_2017' => $text,
                'slug' => $slug,
                'html_title' => $meta_title ?? $title,
                'meta_desc' => $meta_desc ?? $summary,
                //'thumb_url' => $thumb_url,
                //'wide_url' => $wide_url,
                //                'cats' => $cats_array,
                'related_1' => $related_1,
                'related_2' => $related_2,
                'status' => $status == 0 ? 'Unpublished' : 'Published',
                'published_at' => Carbon::parse($created_at)->toDateString(),
                'version' => '2017',
                'created_at' => $created_at,
                'updated_at' => $updated_at,
                'order_column' => ++$order,
            ];
            //            ray($thumb_url, $wide_url);
            //ray($article_new_data);
            $article_new = User::find(1)->news()->create($article_new_data);

            $article_new->categories()->attach($cats_array);

            //CATEGORIES

            $contents_hero = file_get_contents($wide_url);
            $folder_hero = '/migrate/news_hero/';
            $name_hero = urldecode(substr($wide_url, strrpos($wide_url, '/') + 1));
            $path_hero = storage_path('/app/'.$folder_hero);
            //            ray($name_hero, $path_hero);
            Storage::put($folder_hero.$name_hero, $contents_hero);
            $uploaded_hero = new UploadedFile($path_hero.$name_hero, $name_hero);
            //            $uploadedFile = UploadedFile::createFromBase(new \Symfony\Component\HttpFoundation\File\UploadedFile($folder_hero.$name_hero, $name_hero));
            $hero = MediaLibraryItem::addUpload($uploaded_hero, $news_hero_folder);

            $article_new->image_hero = $hero->id;
            $article_new->save();

            $contents_index = file_get_contents($thumb_url);
            $folder_index = '/migrate/news_index/';
            $name_index = urldecode(substr($thumb_url, strrpos($thumb_url, '/') + 1));
            $path_index = storage_path('/app/'.$folder_index);
            //            ray($name_index, $path_index);
            Storage::put($folder_index.$name_index, $contents_index);
            $uploaded_index = new UploadedFile($path_index.$name_index, $name_index);
            //            $uploadedFile = UploadedFile::createFromBase(new \Symfony\Component\HttpFoundation\File\UploadedFile($folder_index.$name_index, $name_index));
            $index = MediaLibraryItem::addUpload($uploaded_index, $news_index_folder);

            $article_new->image_index = $index->id;
            $article_new->save();

            //            $news_hero = $article_new
            //                ->addMediaFromUrl($thumb_url)
            ////                ->width(1536)
            //                ->withResponsiveImages()
            //                ->preservingOriginal()
            //                ->toMediaCollection('news_hero');

            //            $news_index = $article_new
            //                ->addMediaFromUrl($thumb_url)
            ////                ->width(459)
            ////                ->height(459)
            //                ->withResponsiveImages()
            //                ->preservingOriginal()
            //                ->toMediaCollection('news_index');

            //            $article_new->logo_html = $article_new->getFirstMedia('news_index')->toHtml();
            //            $article_new->save();
        }

        //        Storage::deleteDirectory('/migrate/news_hero/');
        //        Storage::deleteDirectory('/migrate/news_index/');
    }
}
