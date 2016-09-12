<?php

namespace App\Http\Controllers;

use Auth;
use App\Http\Requests;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Presentation;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{
	/**
	 * Post a comment to a presentation.
	 */

    public function postComment(CommentRequest $request, $presentationId) 
	{
		$presentation = Presentation::where('id', $presentationId)->first();

		$presentation->comments()->create([
			'user_id' => Auth::user()->id,
			'body' 	  => $request->input('comment')
		]);

		return redirect()->route('presentations.show', $presentation->id)->with([
            'flash_message' => 'Thank you for your comment',
            'flash_message_important' => true
        ]);
	}

	/**
	 * Post a reply to a comment.
	 */
	public function postReply(Request $request, $presentationId, $commentId)
	{
		$this->validate($request, [
				"reply-{$commentId}" => 'required|max:100',
			], [ 
				'required' => 'The reply body is required.'
			]);

		$comment = Comment::notReply()->find($commentId);

		if(!$comment) {
			return redirect()->route('home');
		}

		if(!Auth::user()){
			return redirect()->route('home');
		}

		$reply = Comment::create([
			'user_id'			=> Auth::user()->id,
			'presentation_id' 	=> $presentationId,
			'body'				=> $request->input("reply-{$commentId}"),
		]);

		$comment->replies()->save($reply);

		return redirect()->back();
	}

	/**
	 * Add a like associated with the comment of a presentation.
	 */
	public function like($commentId)
	{
		$comment = Comment::find($commentId);

		if (!$comment){
			return back();
		}

		if(!Auth::user()) {
			return redirect()->route('home');
		}

		if (Auth::user()->hasLikedComment($comment)) {
			return back();
		}

		$like = $comment->likes()->create([
			'user_id' => Auth::user()->id
		]);

		Auth::user()->likes()->save($like);

		return redirect()->back();
	}

	public function flag($commentId)
	{
		$comment = Comment::find($commentId);

		if (!$comment){
			return back();
		}

		if(!Auth::user()) {
			return redirect()->route('home');
		}

		if (Auth::user()->hasFlagged($comment)) {
			return back();
		}

		$flag = $comment->flags()->create([
			'user_id' => Auth::user()->id
		]);

		Auth::user()->flags()->save($flag);

		return redirect()->back();
	}
}
