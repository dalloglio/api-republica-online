<?php

namespace App\Domains\File;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class FileRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = File::class;
}