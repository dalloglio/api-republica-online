<?php

namespace App\Mail;

use App\Domains\Ad\Ad;
use App\Domains\Contact\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdContacted extends Mailable
{
    use Queueable, SerializesModels;

    public $url = 'http://www.google.com/';

    public $ad;

    public $contact;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ad $ad, Contact $contact)
    {
        $this->ad = $ad;
        $this->contact = $contact;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.ads.contacted');
    }
}
