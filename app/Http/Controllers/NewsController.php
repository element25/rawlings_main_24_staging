<?php

namespace App\Http\Controllers;

use App\Enums\StudyStatus;
use App\Models\News;
use App\Models\NewsCategory;

class NewsController extends Controller
{
    public function index($category = null)
    {
        if ($category) {
            $category = NewsCategory::whereSlug($category)->first();
        }
        $categories = NewsCategory::query()
            ->get();

        $news = News::query()
            ->where('status', StudyStatus::PUBLISHED)
            ->orderBy('published_at')
//            ->select(['id', 'title', 'slug', 'logo_html'])
            ->with('categories')
            ->get();

        //        ray(json_decode($categories_json));

        return view('content.news.index', compact('category', 'categories', 'news'));

    }

    public function show($slug)
    {
        $article = News::where('slug', $slug)->with('imageHero')->with('categories')->first();
        //        ray($article->categories);
        ray($article->imageHero->getItem());
        //        $study->load('categories');

        return view('content.news.show', compact('article'));
    }
}
