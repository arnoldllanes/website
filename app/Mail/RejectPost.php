<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RejectPost extends Mailable
{
     use Queueable, SerializesModels;

    public $post;
    public $request;
    public $subject = 'Post on SDLUG.com NOT approved';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($post, $request)
    {
        $this->post = $post;
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.reject')
            ->with([
                'title' => $this->post->title,
                'body' => $this->post->body,
                'submitted_on' => $this->post->created_at,
                'reason' => $this->request->reason
            ]);
    }
}
