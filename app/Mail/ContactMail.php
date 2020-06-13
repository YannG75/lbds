<?php

namespace App\Mail;

use App\MessageData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $messageData;
    public function __construct(MessageData $messageData)
    {
            $this->messageData = $messageData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.mail')
            ->from($this->messageData->email , $this->messageData->name)
            ->subject($this->messageData->subject)
            ->with([
                'msg' => $this->messageData->message,
            ]);

    }
}
