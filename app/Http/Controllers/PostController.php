<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Mail;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('admin', ['only' => ['approve', 'reject', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('approved', true)->latest()->get();
        $posts->load('tags');

        return view('posts.index')->with('posts', $posts);
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

        if(Auth::user()->isGuest()){
            return redirect('posts')->with([
                'flash_message' => 'Your post has been queued for approval. Thanks!',
                'flash_message_important' => true
            ]);
        }

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
    public function edit(Post $post)
    {
        $tags = Tag::all('name', 'id');
        $hasTags = [];

        foreach($post->tags as $tag ){
            $hasTags[] = $tag->id;
        };
        
        return view('posts.edit')->with('post', $post)->with('tags', $tags)->with('hasTags', $hasTags);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, Post $post)
    {   
        $post->update([
                'title' => $request->title,
                'body'  => $request->body,
                'edited_by' => Auth::user()->name,
                'edited_date' => Carbon::now()
            ]);

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return redirect('posts')->with([
            'flash_message' => 'Post was deleted',
            'flash_message_important' => true
        ]);
    }

    /**
     * Allow admin to approve a presentation.
     */
    public function approve($post)
    {
        $post = Post::where('id', $post)->first();

        $post->update(['approved' => 1]);

        return back()->with([
            'flash_message' => 'Presentation Approved',
            'flash_message_important' => true
        ]);
    }

    /**
     * Syncs tags.
     */
    private function syncTags(post $post, $tags)
   {   
      $post->tags()->sync(!$tags ? [] : $tags);
   }

   /**
    * Creates a post.
    */
   private function createPost(PostRequest $request)
   {
        if(Auth::user()->isGuest()){
            $post = Auth::user()->posts()->create([
                'user_id' => Auth::user()->id,
                'published_at' => $request->published_at,
                'title' => $request->title,
                'body' => $request->body,
                'approved' => 0
            ]);

            $this->syncTags($post, $request->input('tag_list'));

            return $post;
        }

         $post = Auth::user()->posts()->create([
            'user_id' => Auth::user()->id,
            'published_at' => $request->published_at,
            'title' => $request->title,
            'body' => $request->body,
            'approved' => 1
        ]);

         $this->syncTags($post, $request->input('tag_list'));

         return $post;
   }

    public function reject(Post $post, Request $request)
    {
        Mail::to($post->owner->email)->send(new \App\Mail\RejectPost($post, $request));
     
        $post->delete();

        return redirect('home')->with([
            'flash_message' => 'Post has been rejected and email sent to publisher.',
            'flash_message_important' => true
        ]);
    }


}
