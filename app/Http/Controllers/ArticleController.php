<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArticleController extends Controller
{
    //
    public function index(Request $request)
    {
        /*
        $querySearch = $request->input('q', '');
        $articles;
        if ($querySearch === '') {
            $articles = Article::paginate();
        } else {
            $articles = Article::where('name', 'like', "%{$querySearch}%")->paginate();
        }*/
        
        $querySearch = $request->input('q');
        $query = Article::query();

        if ($querySearch) {
            $query->where('name', 'like', "%{$querySearch}%");
        }

        $articles = $query->paginate();
        
        //$articles->links();  //вывод постраничной навигации

        // Статьи передаются в шаблон
        // compact('articles') => [ 'articles' => $articles ]
        return view('article.index', compact('articles', 'querySearch'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('article.show', compact('article'));
    }
}
