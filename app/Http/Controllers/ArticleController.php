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

    public function create()
    {
        // Передаём в шаблон вновь созданный объект. Он нужен для вывода формы через Form::model
        $article = new Article();
        return view('article.create', compact('article'));
    }

    // Здесь нам понадобится объект запроса для извлечения данных
    public function store(Request $request)
    {
        // Проверка введённых данных
        // Если будут ошибки, то возникнет исключение
        // Иначе возвращаются данные формы
        $data = $this->validate($request, [
            'name' => 'required|unique:articles',
            'body' => 'required|min:100',
        ]);

        $article = new Article();
        // Заполнение статьи данными из формы
        $article->fill($data);
        // При ошибках сохранения возникнет исключение
        $article->save();

        // Редирект на указанный маршрут
        return redirect()
            ->route('articles.index');
    }
}
