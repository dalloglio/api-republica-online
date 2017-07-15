<?php

namespace App\Domains\Contact;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class ContactRepository extends BaseRepository
{
    use CrudMethods;

    protected $modelClass = Contact::class;
}