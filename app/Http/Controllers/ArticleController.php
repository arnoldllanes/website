<?php

namespace App\Http\Controllers;

use Auth;
use App\Tag;
use App\Article;
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
    	$articles->load('tags','user');

    	return view('articles.index')->with('articles', $articles);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     **/
    public function show($id)
    {
    	$article = Article::where('id', $id)->firstOrfail();
    	$article->load('tags', 'user');

    	return view('articles.show')->with('article', $article);
    }

    public function create()
   {
         $tags = Tag::all('name', 'id');

   		return view('articles.create')->with('tags', $tags);
   }


   //This type hint is from the CreateArticleRequest under App\Requests... The body of this method will not fire unless the validation passes
   public function store(ArticleRequest $request)
   {
         $this->createArticle($request);

   		return redirect('articles')->with([
            'flash_message'   => 'Your article has been created',
            'flash_message_important'  => true
        ]);
   }

   public function edit(Article $article)
   {
      $tags = Tag::lists('name', 'id');

      return view('articles.edit')->with('article', $article)->with('tags', $tags);
   }

   public function update(ArticleRequest $request, Article $article)
   {

      $article->update($request->all());

      $this->syncTags($article, $request->input('tag_list'));

      return redirect('articles');
   }

#Sync up the list of tags in the database
   private function syncTags(Article $article, $tags)
   {
      
      $article->tags()->sync(!$tags ? [] : $tags);
   
   }

#Save a new article
   private function createArticle(ArticleRequest $request)
   {
       //Create an article with the attributes from the form
         $article = Auth::user()->articles()->create($request->all());

         $this->syncTags($article, $request->input('tag_list'));

         return $article;
   }
}
