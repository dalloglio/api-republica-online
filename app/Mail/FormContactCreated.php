<?php

namespace App\Mail;

use App\Domains\Contact\Contact;
use App\Domains\Form\Form;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FormContactCreated extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Form
     */
    public $form;

    /**
     * @var Contact
     */
    public $contact;

    /**
     * @var string
     */
    public $url;

    /**
     * FormContactCreated constructor.
     * @param Form $form
     * @param Contact $contact
     */
    public function __construct(Form $form, Contact $contact)
    {
        $this->form = $form;
        $this->contact = $contact;
        $this->url = 'http://republica.online';
    }

    /**
     * @return $this
     */
    public function build()
    {
        switch ($this->form->type) {
            case 'contact':
                return $this->markdown('emails.contacts.forms.contact_created')
                    ->subject('[Nova mensagem] Nova mensagem de contato.');
                break;
            case 'newsletter':
                return $this->markdown('emails.contacts.forms.newsletter_created')
                    ->subject('[Nova inscrição] Novo registro na newsletter.');
                break;
            case 'resume':
                return $this->markdown('emails.contacts.forms.resume_created')
                    ->subject('[Novo currículo] Novo currículo recebido.');
                break;
            default:
                break;
        }
        return $this;
    }
}
