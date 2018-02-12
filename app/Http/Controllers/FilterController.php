<?php

namespace App\Http\Controllers;

use App\Domains\Filter\FilterRepository;
use App\Http\Requests\Filter\FilterStoreRequest;
use App\Http\Requests\Filter\FilterUpdateRequest;
use App\Support\Traits\CrudController;

class FilterController extends Controller
{
    use CrudController;

    protected $repository;

    public function __construct(FilterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(FilterStoreRequest $request)
    {
        return $this->repository->create($request->all());
    }

    public function update(FilterUpdateRequest $request, $id)
    {
        return $this->repository->update($request->all(), $id);
    }
}