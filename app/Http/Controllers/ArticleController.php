<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    //
    public function index()
    {
        $articles = Article::paginate();
        $articles->links();  //вывод постраничной навигации

        // Статьи передаются в шаблон
        // compact('articles') => [ 'articles' => $articles ]
        return view('article.index', compact('articles'));
    }
}
