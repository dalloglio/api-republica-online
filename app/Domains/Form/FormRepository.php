<?php

namespace App\Domains\Form;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class FormRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Form::class;
}