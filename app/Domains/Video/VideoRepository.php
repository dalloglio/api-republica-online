<?php

namespace App\Domains\Video;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class VideoRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Video::class;
}