<?php

namespace App\Http\Controllers;

use App\Models\HomepageHero;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function __invoke(Request $request)
    {
        $homepage_hero = HomepageHero::first();

        return view('content.homepage.index', compact('homepage_hero'));
    }
}
