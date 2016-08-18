<?php

namespace App\Http\Controllers;

use Auth;
use App\Tag;
use App\Article;
use App\Presenter;
use App\Http\Requests\ArticleRequest;

class ArticleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display listing of the resource.
     *
     * @return response
     */
    public function index()
    {
        $articles = Article::latest()->get();
        $articles->load('tags', 'publisher', 'presenter');

        return view('articles.index')->with('articles', $articles);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return Response
     **/
    public function show($id)
    {
        $article = Article::where('id', $id)->firstOrfail();
        $article->load('tags', 'publisher');

        return view('articles.show')->with('article', $article);
    }

    /**
     * Display form to create an article.
     *
     * @return Response
     */
    public function create()
    {
        $tags = Tag::all('name', 'id');

        return view('articles.create')->with('tags', $tags);
    }


    /**
     * Store the data to create an create.
     *
     * @return Response
     */
    public function store(ArticleRequest $request)
    {
        $this->createArticle($request);

        return redirect('articles')->with([
            'flash_message' => 'Your article has been created',
            'flash_message_important' => true
        ]);
    }

    /**
     * Display the article for editing.
     *
     * @return Reponse
     */
    public function edit(Article $article)
    {
        $tags = Tag::lists('name', 'id');

        return view('articles.edit')->with('article', $article)->with('tags', $tags);
    }


    /**
     * Update the article.
     *
     * @return Response
     */
    public function update(ArticleRequest $request, Article $article)
    {

        $article->update($request->all());

        $this->syncTags($article, $request->input('tag_list'));

        return redirect('articles');
    }

    /**
     * Sync the list of teags in the database
     *
     * @return Reponse
     */
    private function syncTags(Article $article, $tags)
    {

        $article->tags()->sync(!$tags ? [] : $tags);

    }

    /**
     * Logic to create a new article
     *
     * @return $article
     */
    private function createArticle(ArticleRequest $request)
    {
        $presenter = Presenter::where('name', $request->presenter)->first();

        if ($presenter) {
            $presenter->email   = $request->presenter_email;
            $presenter->website = $request->presenter_website;
        }

        if (!$presenter) {
            $presenter = new Presenter([
                'name' => $request->presenter,
                'email' => $request->presenter_email,
                'website' => $request->presenter_website
            ]);
        }

        $presenter->save();

        $article = Auth::user()->articles()->create([
            'user_id' => Auth::user()->id,
            'presenter_id' => $presenter->id,
            'published_at' => $request->published_at,
            'title' => $request->title,
            'body' => $request->body
        ]);

        $this->syncTags($article, $request->input('tag_list'));

        return $article;
    }
}