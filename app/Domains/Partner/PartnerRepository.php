<?php

namespace App\Domains\Partner;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class PartnerRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Partner::class;
}