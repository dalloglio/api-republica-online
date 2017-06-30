<?php

namespace App\Domains\Address;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class AddressRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Address::class;
}