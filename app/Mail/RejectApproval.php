<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RejectApproval extends Mailable
{
    use Queueable, SerializesModels;

    public $presentation;
    public $request;
    public $subject = 'Post on SDLUG.com NOT approved';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($presentation, $request)
    {
        $this->presentation = $presentation;
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
                'title' => $this->presentation->title,
                'body' => $this->presentation->body,
                'submitted_on' => $this->presentation->created_at,
                'reason' => $this->request->reason
            ]);
    }
}
