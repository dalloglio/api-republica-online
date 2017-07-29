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

    /**
     * @var array
     */
    protected $relationships = ['contacts'];

    public function setRelationships($relationships = [])
    {
    	$this->relationships = $relationships;
    }
}