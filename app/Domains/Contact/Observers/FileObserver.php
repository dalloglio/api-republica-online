<?php

namespace App\Domains\Contact\Observers;

use App\Domains\Contact\Contact;

class FileObserver
{
    private $request;

    public function __construct()
    {
        $this->request = request();
    }

    public function saved(Contact $contact)
    {
        if ($this->request->hasFile('file')) {
            if ($contact->file) {
                $file = $contact->file;
                $file->update(['file' => $this->request->file('file')]);
            } else {
                $contact->file()->create(['file' => $this->request->file('file')]);
            }
        }
    }

    public function deleted(Contact $contact)
    {
        $this->deleteFile($contact);
    }

    public function deleteFile(Contact $contact)
    {
        if ($contact->file) {
            $contact->file->delete();
        }
    }
}