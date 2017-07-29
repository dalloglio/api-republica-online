<?php

namespace App\Domains\Filter;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class FilterRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Filter::class;

    /**
     * @var array
     */
    protected $relationships = ['inputs'];
}