<?php

use Illuminate\Support\Facades\Route;

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
    //return view('about', ['tags' => $tags]);
    //return view('about');
});

Route::get('articles', function () {
    return view('articles');
});
