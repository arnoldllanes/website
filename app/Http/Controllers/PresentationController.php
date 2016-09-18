<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Tag;
use App\Http\Requests;
use App\Models\Presenter;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\PresentationRequest;

class PresentationController extends Controller
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
        $presentations = Presentation::where('approved', true)->latest()->get();
        $presentations->load('tags', 'publisher', 'presenter');

        return view('presentations.index')->with('presentations', $presentations);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Presentation $presentation)
    {
        $presentation->load('tags', 'publisher');

        $comments = $presentation->comments()->notReply()->get();

        if($presentation->approved === 0 && Auth::user()->isAdmin() === false) {
            return back();
        }
       
        return view('presentations.show')->with('presentation', $presentation)->with('comments', $comments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = DB::table('tags')->orderBy('name', 'ASC')->get();

        return view('presentations.create')->with('tags', $tags);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresentationRequest $request)
    {
        $this->createPresentation($request);

        if(Auth::user()->isGuest()){
            return redirect('presentations')->with([
                'flash_message' => 'Your presentation has been queued for approval. Thanks!',
                'flash_message_important' => true
            ]);
        }

        return redirect('presentations')->with([
            'flash_message' => 'Your presentation has been created.',
            'flash_message_important' => true
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Presentation $presentation)
    {
        $tags = Tag::all('name', 'id');
        $hasTags = [];

        foreach($presentation->tags as $tag ){
            $hasTags[] = $tag->id;
        };
        
        return view('presentations.edit')->with('presentation', $presentation)->with('tags', $tags)->with('hasTags', $hasTags);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy(Presentation $presentation)
    {
        $presentation->delete();

        return redirect('presentations')->with([
            'flash_message' => 'Presentation was deleted',
            'flash_message_important' => true
        ]);
    }

    /**
     * Rejects a guest users post.
     */
    public function reject(Presentation $presentation, Request $request)
    {
        Mail::to($presentation->publisher->email)->send(new \App\Mail\RejectApproval($presentation, $request));
     
        $presentation->delete();

        return redirect('home')->with([
            'flash_message' => 'Successfully rejected post.',
            'flash_message_important' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PresentationRequest $request, Presentation $presentation)
    {
        $presenter = Presenter::where('name', $request->presenter)->first();        
        $this->updatePresentationInfo($presenter, $request, $presentation);
        
        return redirect()->route('presentations.show', $presentation->id);
    }

    private function updatePresentationInfo($presenter, $request, $presentation)
    {
        if ($presenter) {
            $presenter->email   = $request->presenter_email;
            $presenter->website = $request->presenter_website;

            $presentation->presenter->update([
                'email'   => $request->presenter_email,
                'website' => $request->presenter_website
            ]);
        }

        if (!$presenter) {
            $presenter = new Presenter([
                'name'    => $request->presenter,
                'email'   => $request->presenter_email,
                'website' => $request->presenter_website
            ]);

            $presenter->save();

            $presentation->presenter->update([
                'name'    => $presenter->name,
                'email'   => $presenter->email,
                'website' => $presenter->website
            ]);
        }

            $presentation->update([
                'title' => $request->title,
                'body'  => $request->body,
                'edited_by' => Auth::user()->name,
                'edited_date' => Carbon::now()
            ]);

            $this->syncTags($presentation, $request->input('tag_list'));
    }

    /**
     * Sync the list of tags in the database
     *
     * @return Reponse
     */
    private function syncTags(Presentation $presentation, $tags)
    {

        $presentation->tags()->sync(!$tags ? [] : $tags);

    }

    /**
     * Logic to create a new presentation
     *
     * @return $presentation
     */
    private function createPresentation(PresentationRequest $request)
    {
        $presenter = Presenter::where('name', $request->presenter)->first();

        $this->createOrUpdatePresenterInfo($presenter, $request);

    }

    private function createOrUpdatePresenterInfo($presenter, $request)
    {
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

        if(Auth::user()->isGuest()){
            $presentation = Auth::user()->presentations()->create([
                'user_id' => Auth::user()->id,
                'presenter_id' => $presenter->id,
                'published_at' => $request->published_at,
                'title' => $request->title,
                'body' => $request->body,
                'video_embed' => $request->video_embed,
                'approved' => 0
            ]);

            $this->syncTags($presentation, $request->input('tag_list'));

            return $presentation;
        }

        $presentation = Auth::user()->presentations()->create([
            'user_id' => Auth::user()->id,
            'presenter_id' => $presenter->id,
            'published_at' => $request->published_at,
            'title' => $request->title,
            'body' => $request->body,
            'video_embed' => $request->video_embed,
            'approved' => 1
        ]);

        $this->syncTags($presentation, $request->input('tag_list'));

        return $presentation;
    }

    /**
     * Allow admin to approve a presentation.
     */
    public function approve($presentation)
    {
        $presentation = Presentation::where('id', $presentation)->first();

        $presentation->update(['approved' => 1]);

        return back()->with([
            'flash_message' => 'Presentation Approved',
            'flash_message_important' => true
        ]);
    }
}
