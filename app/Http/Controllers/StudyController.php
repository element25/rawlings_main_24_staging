<?php

namespace App\Http\Controllers;

use App\Enums\StudyStatus;
use App\Models\Study;
use App\Models\StudyCategory;
use Illuminate\Contracts\Database\Eloquent\Builder;

class StudyController extends Controller
{
    public function index()
    {
        $categories = StudyCategory::query()
            ->has('studies')
            ->with(['studies' => function (Builder $query) {
                $query->where('status', StudyStatus::PUBLISHED)->select('id', 'title', 'slug', 'logo_html');
            }])
            ->orderBy('order_column')->select(['id', 'name', 'colour'])
            ->get();

        $studies = Study::query()
            ->with('categories:id,name')
            ->where('status', StudyStatus::PUBLISHED)
            ->orderBy('order_column')
            ->select(['id', 'title', 'slug', 'logo_html'])
            ->get();

        $categories_json = $categories->toJson();
        $studies_json = $studies->toJson();

        //        ray(json_decode($categories_json));

        return view('content.studies.index', compact('categories_json', 'studies_json'));

    }

    public function show($slug)
    {
        $study = Study::where('slug', $slug)->first();

        $study->load('categories');

        return view('content.studies.show', compact('study'));
    }
}
