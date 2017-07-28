<?php

namespace App\Support;

use App\Support\Contracts\Segregated\CrudRepository;
use App\Support\Traits\CrudMethods;

abstract class AbstractCrudRepository extends BaseRepository implements CrudRepository
{
     use CrudMethods;
}