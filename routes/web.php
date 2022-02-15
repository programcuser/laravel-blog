<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ArticleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('about', [PageController::class, 'about']);
/*
Route::get('about', function () {
    $tags = ['обучение', 'программирование', 'php', 'oop'];
    $team = [
        ['name' => 'John', 'position' => 'manager'],
        ['name' => 'Jane', 'position' => 'office director'],
        ['name' => 'Bill', 'position' => 'software engineer'],
        ['name' => 'Jessy', 'position' => 'QA tester'],
        ['name' => 'Tom', 'position' => 'lawyer']
    ];
    return view('about', ['team' => $team]);
});
*/

/*
Route::get('articles', function () {
    return view('articles');
});
*/

Route::get('articles', [ArticleController::class, 'index'])
    ->name('articles.index');

# id – параметр, который зависит от конкретной статьи
# Фигурные скобки нужны для описания параметров маршрута
Route::get('articles/{id}', [ArticleController::class, 'show'])
  ->name('articles.show');
