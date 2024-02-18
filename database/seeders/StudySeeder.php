<?php

namespace Database\Seeders;

use App\Enums\StudyStatus;
use App\Models\Study;
use App\Models\StudyCategory;
use Illuminate\Database\Seeder;

class StudySeeder extends Seeder
{
    public function run(): void
    {
        $categories = StudyCategory::all()->pluck('id');
        //        ray($categories);

        $study = Study::factory()->createQuietly([
            'title' => 'Willys ACV',
            'related_title' => 'Willys ACV',
            'html_title' => 'Willys ACV',
            'meta_desc' => 'Willys ACV',
            'slug' => 'willys-acv',
            'brief' => '<p>William Chase, founder of Tyrrells Crisps and Chase Vodka launched his third brand Willy’s ACV (Apple Cider Vinegar) in 2015.</p><p>Having worked with Willy’s since then to supply a distinctive glass bottle for their ACV ‘The Mother’, we were tasked with developing a premium can package for their innovative Kombucha and ACV Sparkling Health Drink.</p>',
            'approach' => '<p>Willy’s wanted a sleek and professional printed can solution that would appeal to the growing health conscious market looking for natural drink alternatives from brands with an ethical & sustainable ethos.</p><p>To hit the brief, we approached Willy’s with our 250ml Slim Line can solution and suggested a soft touch varnish print to help create a point of difference whilst giving a more premium, natural feel. Willy’s thought this solution was “perfect”.</p><p>It was then a case of working closely with Willy’s, managing the project from origination, proofing and then finally being with them on the production line when it came to sign-off.</p>',
            'result' => '<p>It looks as though William Chase has hit another home-run with his third and “most exciting brand launch yet” with the likes of Waitrose, Selfridges, Havey Nichols, Planet Organic and Bayley and Sage being some of the establishments listing Willy’s natural health drinks.</p><p>Following on from this success Willy’s has released non-alcoholic kombucha beers and ACV waters using our 250ml Slim Line can solution.</p>',
            'quote' => 'Throughout the process Rawlings have been able to hold our hand… and with lovely customer service to support.',
            'client' => 'CATH WHITE, MARKETING MANAGER, WILLY\'S ACV',
            //            'image_hero' => '',
            //            'image_half_1' => '',
            //            'image_half_2' => '',
            //            'image_full_top' => '',
            //            'image_full_bottom' => '',
            'url' => 'https://www.willysacv.com',
            //            'categories' => ['1', '2', '3'],
            //            'user_id' => 1,
            'status' => StudyStatus::PUBLISHED,
        ]);

        //        $study->categories()->attach($categories->random(3));
        $this->saveImage($study, 'seeddata/studies/hero.jpg', 'studies_show_hero');
        $this->saveImage($study, 'seeddata/studies/brief.jpg', 'studies_show_brief');
        $this->saveImage($study, 'seeddata/studies/approach.jpg', 'studies_show_approach');
        $this->saveImage($study, 'seeddata/studies/image_1.jpg', 'studies_show_full_top');
        $this->saveImage($study, 'seeddata/studies/image_2.jpg', 'studies_show_full_bottom');
        $this->saveImage($study, 'seeddata/studies/tompom.jpg', 'studies_homepage');
        //        $this->saveImage($study, 'seeddata/studies/our_work_neura.jpg', 'studies_our_work');

        Study::factory(10)->createQuietly();
        Study::factory(3)->draft()->createQuietly();
        Study::factory(3)->scheduled()->createQuietly();
        Study::factory(3)->unpublished()->createQuietly();

        $studies = Study::all(); //whereNot('id', $study->id)->get();
        $studies->each(function (Study $study, int $key) {
            $logos = ['neura', 'number1', 'yumchaa'];
            $logo = $logos[array_rand($logos)];
            $this->saveImage($study, 'seeddata/studies/related_'.rand(1, 2).'.jpg', 'studies_show_related');
            $this->saveImage($study, 'seeddata/studies/our_work_'.$logo.'.jpg', 'studies_our_work');
            //            $categories_inside = $categories;
            $categories_inside = StudyCategory::all()->pluck('id');
            $category_1 = $categories_inside->pull($categories_inside->random() - 1);
            $category_2 = $categories_inside->pull($categories_inside->random() - 1);
            $category_3 = $categories_inside->pull($categories_inside->random() - 1);
            $study->categories()->attach([$category_1, $category_2, $category_3]);
            $study->order_column = $study->id;
            $study->save();
        });
    }

    protected function saveImage($study2, $image_path, $collection)
    {
        $study2
            ->addMedia(storage_path($image_path))
            ->withResponsiveImages()
            ->preservingOriginal()
//            ->toMediaCollection($collection, 'local_filament_image_uploads');
            ->toMediaCollection($collection);

        if ($collection == 'studies_our_work') {
            $study2->logo_html = $study2->getFirstMedia('studies_our_work')->toHtml();
            $study2->save();
        }
    }
}
