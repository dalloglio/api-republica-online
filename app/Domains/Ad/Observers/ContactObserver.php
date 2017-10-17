<?php

namespace App\Domains\Ad\Observers;

use App\Domains\Ad\Ad;

class ContactObserver
{
    private $request;

    public function __construct()
    {
        $this->request = request();
    }

    /**
     * @param Ad $ad
     */
    public function saved(Ad $ad)
    {
        if ($this->request->has('contact')) {
            $contact = $this->request->contact;
            if ($ad->contact) {
                $ad->contact->update($contact);
            } else {
                $ad->contact()->create($contact);
            }
        }
    }

    /**
     * @param Ad $ad
     */
    public function deleted(Ad $ad)
    {
        if ($ad->contact) {
            $ad->contact->delete();
        }
    }
}
