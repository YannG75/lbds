<?php

namespace App\Mail;

use App\MessageData;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserMail extends Mailable
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
        return $this->view('emails.customer')
            ->from('contact@lbds.fr')
            ->subject('confirmation de Commande')
            ->with([
                'msg' => $this->messageData->message,
                'customer' => $this->messageData->customer,
                'order' => $this->messageData->order,
            ]);
    }
}
