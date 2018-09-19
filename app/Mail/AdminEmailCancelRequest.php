<?php

namespace Rota\Mail;

use Rota\Models\Item;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminEmailCancelRequest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    public $requests;
    public $token;

    public function __construct($requests)
    {
        $this->requests = $requests;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Rota Administration: Request to cancel item')->markdown('emails.admin.cancel');
    }
}
