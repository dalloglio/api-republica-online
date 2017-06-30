<?php

namespace App\Domains\Photo;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class PhotoRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Photo::class;
}