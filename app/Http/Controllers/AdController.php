<?php

namespace App\Http\Controllers;

use App\Domains\Ad\AdRepository;
use App\Http\Requests\Ad\AdStoreRequest;
use App\Http\Requests\Ad\AdUpdateRequest;
use App\Support\Traits\CrudController;

class AdController extends Controller
{
    use CrudController;

    protected $repository;

    public function __construct(AdRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(AdStoreRequest $request)
    {
        return $this->repository->create($request->all());
    }

    public function update(AdUpdateRequest $request, $id)
    {
        return $this->repository->update($request->all(), $id);
    }
}
