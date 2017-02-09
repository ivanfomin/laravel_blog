<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Article;

class IndexController extends Controller
{
    protected $header;
    protected $message;

    public function __construct()
    {
        $this->header = 'Блог Новостей';
        $this->message = 'Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне.
         Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века.
          В то время некий безымянный печатник создал большую коллекцию размеров и форм шрифтов,
           используя Lorem Ipsum для распечатки образцов.
            Lorem Ipsum не только успешно пережил без заметных изменений пять веков,
             но и перешагнул в электронный дизайн.
              Его популяризации в новое время послужили публикация листов Letraset с образцами Lorem Ipsum в 60-х годах и,
               в более недавнее время, программы электронной вёрстки типа Aldus PageMaker,
                в шаблонах которых используется Lorem Ipsum.';
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::select(['id', 'name', 'brief', 'img', 'content'])->get();

        return view('article')->with(['header' => $this->header, 'message' => $this->message, 'articles' => $articles]);

    }

    public function add(Request $request=null)
    {
        if($request->isMethod('post')) {
           $request->flash();
        }
        return view('add-content')->with(['header' => $this->header, 'message' => $this->message]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->flash();
        $this->validate($request, [
            'name' => 'required |  max:255 ',
            'brief' => 'required',
            'content' => 'required'
        ]);

        $data = $request->all();

        $article = new Article();

        $article->fill($data);

        $article->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);

        return view('article-content')->with(['header' => $this->header, 'message' => $this->message, 'article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = $request->all();
        if ($data['del'] == 'true') {
            return $this->delete($data['art']);
        } else
            return redirect('/');
    }

    public function delete($article)
    {

        $article_tmp = \App\Article::where('id', $article)->first();

        $article_tmp->delete();

        return redirect('/');
    }

    public function formDelete($article)
    {
        return view('article-delete')->with('article', $article);
    }
}
