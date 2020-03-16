<?php

namespace App\Mail;

use App\Need;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class HelpOffered extends Mailable
{
    use Queueable, SerializesModels;

    /** @var Need $need */
    public $need;
    /**
     * @var array
     */
    public $helper;

    /**
     * Create a new message instance.
     *
     * @param Need $need
     */
    public function __construct(Need $need, array $helper)
    {
        $this->need = $need;
        $this->helper = $helper;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->need->title)
            ->view('emails.helpoffered');
//            ->markdown('emails.helpoffered');
    }
}
