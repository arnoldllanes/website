<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Post;
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

    public function postComment(CommentRequest $request, $id, $type) 
	{
		$this->postAccordingToCommentType($request, $id, $type);

		return back()->with([
	            'flash_message' => 'Thank you for your comment',
	            'flash_message_important' => true
	        ]);
	}

	/**
	 * Determines whether to post comment to presentation or to blog
	 */

	private function postAccordingToCommentType($request, $id, $type)
	{
		if($type === 'presentation') {
			$presentation = Presentation::where('id', $id)->first();

			$presentation->comments()->create([
				'user_id' => Auth::user()->id,
				'body' 	  => $request->input('comment'),
				'flagged' => 0
			]);
		}

		if($type === 'blog'){
			$post = Post::where('id', $id)->first();

			$post->comments()->create([
				'user_id' => Auth::user()->id,
				'body' => $request->input('comment'),
				'flagged' => 0
			]);
		}

		return false;
	}

	/**
	 * Post a reply to a comment.
	 */
	public function postReply(Request $request, $id, $commentId, $type)
	{
		$this->validate($request, [
				"reply-{$commentId}" => 'required|max:100',
			], [ 
				'required' => 'The reply body is required.'
			]);

		$this->postReplyAccordingToType($request, $id, $commentId, $type);

		return back()->with([
            'flash_message' => 'Successfully submitted comment.',
            'flash_message_important' => true
        ]);;

	}

	/**
	 * Post reply to comment according to post type.
	 */
	private function postReplyAccordingToType($request, $id, $commentId, $type)
	{
		if($type === 'presentation') {
			$comment = Comment::notReply()->find($commentId);

			if(!$comment) {
				return redirect()->route('home');
			}

			if(!Auth::user()){
				return redirect()->route('home');
			}

			$reply = Comment::create([
				'user_id'			=> Auth::user()->id,
				'presentation_id' 	=> $id,
				'body'				=> $request->input("reply-{$commentId}"),
				'flagged'    		=> 0
			]);

			$comment->replies()->save($reply);
		}

		if($type === 'blog') {
			$comment = Comment::notReply()->find($commentId);

			if(!$comment) {
				return redirect()->route('home');
			}

			if(!Auth::user()){
				return redirect()->route('home');
			}

			$reply = Comment::create([
				'user_id'			=> Auth::user()->id,
				'post_id' 			=> $id,
				'body'				=> $request->input("reply-{$commentId}"),
				'flagged'    		=> 0
			]);

			$comment->replies()->save($reply);
		}

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
