<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Start;
use Illuminate\Support\Facades\Lang;

class ResultMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $start;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Start $start)
    {
        $this->start=$start;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(Lang::get("New result is available"))->markdown('mail.result.new', [
                    'start' => $this->start,
                ]);
    }
}
