<?php

namespace App\Mail;

use App\Need;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NeedInserted extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Need $need */
    public $need;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Need $need)
    {
        $this->need = $need;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Neues Hilfegesuch')
            ->view('emails.needinserted');
    }
}
