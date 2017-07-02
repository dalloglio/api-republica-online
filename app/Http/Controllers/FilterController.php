<?php

namespace App\Http\Controllers;

use App\Domains\Filter\FilterRepository;
use App\Support\Traits\CrudController;

class FilterController extends Controller
{
    use CrudController;

    protected $repository;

    public function __construct(FilterRepository $repository)
    {
        $this->repository = $repository;
    }
}
