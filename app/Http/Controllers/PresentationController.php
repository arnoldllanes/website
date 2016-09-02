<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Presenter;
use App\Models\Presentation;
use App\Http\Requests\PresentationRequest;

class PresentationController extends Controller
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
        $presentations = Presentation::latest()->get();
        $presentations->load('tags', 'publisher', 'presenter');

        return view('presentations.index')->with('presentations', $presentations);
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

        $presentation = Presentation::where('id', $id)->firstOrfail();
        $presentation->load('tags', 'publisher');

        $comments = $presentation->comments()->notReply()->get();

        return view('presentations.show')->with('presentation', $presentation)->with('comments', $comments);
    }

    /**
     * Display form to create an presentation.
     *
     * @return Response
     */
    public function create()
    {
        $tags = DB::table('tags')->orderBy('name', 'ASC')->get();

        return view('presentations.create')->with('tags', $tags);
    }


    /**
     * Store the data to create an create.
     *
     * @return Response
     */
    public function store(PresentationRequest $request)
    {
        $this->createPresentation($request);

        return redirect('presentations')->with([
            'flash_message' => 'Your presentation has been created',
            'flash_message_important' => true
        ]);
    }

    /**
     * Display the presentation for editing.
     *
     * @return Reponse
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

    public function destroy(Presentation $presentation)
    {
        $presentation->delete();

        return redirect('presentations')->with([
            'flash_message' => 'Presentation was deleted',
            'flash_message_important' => true
        ]);
    }

    /**
     * Update the presentation.
     *
     * @return Response
     */
    public function update(PresentationRequest $request, Presentation $presentation)
    {
        $presenter = Presenter::where('name', $request->presenter)->first();

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

        return redirect()->route('presentations.show', $presentation->id);
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

        $presentation = Auth::user()->presentations()->create([
            'user_id' => Auth::user()->id,
            'presenter_id' => $presenter->id,
            'published_at' => $request->published_at,
            'title' => $request->title,
            'body' => $request->body,
            'video_embed' => $request->video_embed
        ]);

        $this->syncTags($presentation, $request->input('tag_list'));

        return $presentation;
    }
}
