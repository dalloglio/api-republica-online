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

    public $ad;

    public $contact;

    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ad $ad, Contact $contact)
    {
        $this->ad = $ad;
        $this->contact = $contact;
        $this->url = 'http://republica.online/anuncio/' . $ad->slug;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('emails.ads.contacted')->subject('[Nova Mensagem] Seu anúncio recebeu uma nova mensagem.');
    }
}
