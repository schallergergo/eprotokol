<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Lang;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $message;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $message)
    {
        $this->message=$message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(Lang::get("New message"))->replyTo($this->message["email"])->markdown('mail.contact', [
                    'name' => $this->message["name"],
                    'email' => $this->message["email"],
                    'message' => $this->message["message"],

                ]);
    }
}
