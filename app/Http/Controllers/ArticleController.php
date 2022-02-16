<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;

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

        $flash = $request->session()->get('status'); //get Flash Message
        
        //$articles->links();  //вывод постраничной навигации

        // Статьи передаются в шаблон
        // compact('articles') => [ 'articles' => $articles ]
        return view('article.index', compact('articles', 'querySearch', 'flash'));
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
    public function store(StoreArticleRequest $request)
    {
        // Проверка введённых данных
        // Если будут ошибки, то возникнет исключение
        // Иначе возвращаются данные формы
        //$data = $this->validate($request, [
        //   'name' => 'required|unique:articles',
        //    'body' => 'required|min:100',
        //]);
        $data = $request->validated();

        $article = new Article();
        // Заполнение статьи данными из формы
        $article->fill($data);
        // При ошибках сохранения возникнет исключение
        $article->save();

        $request->session()->flash('status', 'The article was created successful!');

        // Редирект на указанный маршрут
        return redirect()
            ->route('articles.index');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('article.edit', compact('article'));
    }

    public function update(StoreArticleRequest $request, $id)
    {
        $article = Article::findOrFail($id);
        //$data = $this->validate($request, [
            // У обновления немного изменённая валидация. В проверку уникальности добавляется название поля и id текущего объекта
            // Если этого не сделать, Laravel будет ругаться на то что имя уже существует
        //    'name' => 'required|unique:articles,name,' . $article->id,
        //    'body' => 'required|min:100',
        //]);

        $data = $request->validated();

        $article->fill($data);
        $article->save();

        $request->session()->flash('status', 'The article was updated successful!');

        return redirect()
            ->route('articles.index');
    }

    public function destroy($id)
    {
        // DELETE — идемпотентный метод, поэтому результат операции всегда один и тот же
        $article = Article::find($id);
        if ($article) {
            $article->delete();
        }

        session()->flash('status', 'The article was deleted successful!');

        return redirect()->route('articles.index');
    }
}
