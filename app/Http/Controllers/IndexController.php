<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Article;
use Auth;
use Gate;

class IndexController extends Controller
{
    protected $header;
    protected $message;
    protected $user;

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

        $this->middleware('auth');


    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        //dump($this->user);
        $this->user = Auth::user();

        $articles = Article::select(['id', 'name', 'brief', 'img', 'content', 'user_id'])->get();

        return view('article')->with(['header' => $this->header, 'message' => $this->message, 'articles' => $articles, 'user' => $this->user]);

    }

    public function add(Request $request = null)
    {
        if ($request->isMethod('post')) {
            $request->flash();
        }
        return view('add-content')->with(['header' => $this->header, 'message' => $this->message]);

    }

    public function edit($id)
    {
        $article = Article::find($id);

        return view('update-content')->with(['header' => $this->header, 'message' => $this->message, 'article' => $article]);


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
        //$request->flashOnly('name', 'brief', 'content');

        $this->user = Auth::user();

        if(Gate::denies('add-content')) {
            return redirect()->back()->with(['message'=>'У вас нет прав!']);
        }

        $this->validate($request, [
            'name' => 'required |  max:255 ',
            'brief' => 'required',
            'content' => 'required'
        ]);



        $data = $request->all();

        $article = new Article();

        $article->fill($data);
        $article->user_id = $this->user->id;
        $article->save();

        return redirect('/')->with(['message'=>'Материал добавлен!']);
    }

    /**
     * Display the specified resource.
     * 321654   *
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required |  max:255 ',
            'brief' => 'required',
            'content' => 'required'
        ]);

        $this->user = Auth::user();

        $data = $request->all();

        $article = Article::find($data['id']);

        if(Gate::allows('update-content', $article)) {

            $article->fill($data);

            $article->save();

            return redirect('/')->with(['message' => 'Материал обнавлен!']);
        }

        return redirect()->back()->with(['message'=>'У вас нет прав!']);

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



        if ( !isset($data['del']) || $data['del'] != 'true') {

            return redirect('/');

        } else {

            return $this->delete($data['art']);
        }
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
