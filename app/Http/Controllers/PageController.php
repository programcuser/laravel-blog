<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //
    public function about()
    {
        $tags = ['обучение', 'программирование', 'php', 'oop'];
        $team = [
            ['name' => 'John', 'position' => 'manager'],
            ['name' => 'Jane', 'position' => 'office director'],
            ['name' => 'Bill', 'position' => 'software engineer'],
            ['name' => 'Jessy', 'position' => 'QA tester'],
            ['name' => 'Tom', 'position' => 'lawyer']
        ];

        return view('page.about', ['team' => $team]);
    }
}
