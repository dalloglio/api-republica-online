<?php

namespace App\Http\Controllers;

use App\Domains\Category\CategoryRepository;
use App\Support\Traits\CrudController;

class CategoryController extends Controller
{
    use CrudController;

    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }
}
