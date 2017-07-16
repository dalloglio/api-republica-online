<?php

namespace App\Domains\Banner;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class BannerRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Banner::class;
}