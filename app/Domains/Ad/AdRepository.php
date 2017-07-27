<?php

namespace App\Domains\Ad;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class AdRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Ad::class;

    /**
     * @var array
     */
    protected $relationships = ['user'];
}