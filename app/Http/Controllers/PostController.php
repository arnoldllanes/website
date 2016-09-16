<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Models\Tag;
use App\Models\Post;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['only' => ['store', 'create', 'edit']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest('published_at')->published()->get();
        $latest = Post::latest()->first();

        return view('posts.index')->with('posts', $posts)->with('latest', $latest);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = DB::table('tags')->orderBy('name', 'ASC')->get();

        return view('posts.create')->with('tags', $tags);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $this->createPost($request);

        return redirect('posts')->with([
            'flash_message' => 'Your post has been created.',
            'flash_message_important' => true
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(post $post)
    {
        $tags = Tag::lists('name', 'id');

        return view('posts.edit')->with('post', $post)->with('tags', $tags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post->update($request->all());

        $this->syncTags($post, $request->input('tag_list'));

        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function syncTags(post $post, $tags)
   {
      
      $post->tags()->sync(!$tags ? [] : $tags);
   
   }

   private function createPost(PostRequest $request)
   {
         $post = Auth::user()->posts()->create($request->all());

         $this->syncTags($post, $request->input('tag_list'));

         return $post;
   }


}
