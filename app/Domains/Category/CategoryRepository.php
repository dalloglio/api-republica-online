<?php

namespace App\Domains\Category;

use App\Support\BaseRepository;
use App\Support\Traits\CrudMethods;

class CategoryRepository extends BaseRepository
{
    use CrudMethods;

    /**
     * @var string
     */
    protected $modelClass = Category::class;

    /**
     * @var array
     */
    protected $relationships = ['filters'];
}