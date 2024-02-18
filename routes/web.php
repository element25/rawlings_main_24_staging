<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', HomepageController::class)->name('homepage');

Route::get('/login', function () {
    return redirect('rawl-admin/login');
})->name('login');

Route::get('/case-studies', [StudyController::class, 'index'])->name('studies.index');
Route::get('/case-studies/{study:slug}', [StudyController::class, 'show'])->name('studies.show');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
//ray(NewsCategory::all()->pluck('slug')->toArray());
//Route::get('/news/{category?}', [NewsController::class, 'index'])->whereIn('category', NewsCategory::all()->pluck('slug')->toArray())->name('news.category');
Route::get('/news/{category?}', [NewsController::class, 'index'])->whereIn('category', ['general', 'insights', 'inspiration', 'products'])->name('news.category');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/products', [ProductController::class, 'index'])->name('product.index');
