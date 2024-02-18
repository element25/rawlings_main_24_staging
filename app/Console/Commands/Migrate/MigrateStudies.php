<?php

namespace App\Console\Commands\Migrate;

use App\Models\Study;
use App\Models\StudyCategory;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RalphJSmit\Filament\MediaLibrary\Media\Models\MediaLibraryFolder;

class MigrateStudies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:studies';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate case studies from old site';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        DB::table('study_category')->truncate();
        Study::truncate();
        StudyCategory::truncate();

        StudyCategory::create([
            'name' => 'New product development',
            'short_name' => 'NPD',
            'colour' => 'text-rawl-purple',
        ]);
        StudyCategory::create([
            'name' => 'Bespoke glass',
            'short_name' => 'Bespoke glass',
            'colour' => 'text-teal-700',
        ]);
        StudyCategory::create([
            'name' => 'Bespoke labels',
            'short_name' => 'Bespoke labels',
            'colour' => 'text-rawl-blue',
        ]);
        StudyCategory::create([
            'name' => 'Logo designs',
            'short_name' => 'Logo designs',
            'colour' => 'text-rawl-blue',
        ]);
        StudyCategory::create([
            'name' => 'Label design',
            'short_name' => 'Label design',
            'colour' => 'text-rawl-blue',
        ]);

        $studies_folder = MediaLibraryFolder::create(['name' => 'Studies']);
        $news_index_folder = MediaLibraryFolder::create(['parent_id' => $studies_folder->id, 'name' => 'Index']);
        $news_hero_folder = MediaLibraryFolder::create(['parent_id' => $studies_folder->id, 'name' => 'Hero']);

        //        $studies = DB::connection('mysql_main_production')->table('studies')
        //            ->orderBy('created_at', 'asc')
        //            ->get();
        //ray($studies);

        $order = 0;

        $belu_old = DB::connection('mysql_main_production')->table('studies')->whereSlug('belu-water-311')->first();
        //        dd(explode(',', $belu_old->related));
        $belu_old->related = Str::of($belu_old->related)->trim(',');
        $belu_data = [
            'id' => $belu_old->id,
            'title' => $belu_old->title,
            'related_title' => Str::of($belu_old->title)->limit(20),
            'html_title' => $belu_old->title,
            'meta_desc' => $belu_old->summary,
            'slug' => $belu_old->slug,
            'url' => $belu_old->link,
            'related' => $belu_old->featured,
            'article_1' => isset(explode(',', $belu_old->related)[0]) ? explode(',', $belu_old->related)[0] : null,
            'article_2' => isset(explode(',', $belu_old->related)[1]) ? explode(',', $belu_old->related)[1] : null,
            'article_3' => isset(explode(',', $belu_old->related)[2]) ? explode(',', $belu_old->related)[2] : null,
            'status' => 'Published',
            'published_at' => Carbon::parse($belu_old->created_at)->toDateString(),
            'created_at' => $belu_old->created_at,
            'updated_at' => $belu_old->updated_at,
            'order_column' => ++$order,

            'homepage_text' => 'homepage_text',
            'study_list_text' => 'study_list_text',

            'brief' => '',
            'approach' => '',
            'result' => '',
            'quote' => '',
            'client' => '',
        ];

        $belu_new = Study::create($belu_data);

        $studies = Study::all(); //whereNot('id', $study->id)->get();
        $studies->each(function (Study $study, int $key) {
            $categories_inside = StudyCategory::all()->pluck('id');
            $category_1 = $categories_inside->pull($categories_inside->random() - 1);
            $category_2 = $categories_inside->pull($categories_inside->random() - 1);
            $category_3 = $categories_inside->pull($categories_inside->random() - 1);
            $study->categories()->attach([$category_1, $category_2, $category_3]);
            $study->save();
        });

    }
}
