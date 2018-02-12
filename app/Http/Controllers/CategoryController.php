<?php

namespace App\Http\Controllers;

use App\Domains\Category\CategoryRepository;
use App\Http\Requests\Category\CategoryStoreRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Support\Traits\CrudController;

class CategoryController extends Controller
{
    use CrudController;

    protected $repository;

    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(CategoryStoreRequest $request)
    {
        return $this->repository->create($request->all());
    }

    public function update(CategoryUpdateRequest $request, $id)
    {
        return $this->repository->update($request->all(), $id);
    }
}
