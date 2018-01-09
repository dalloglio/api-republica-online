<?php

namespace App\Http\Controllers;

use App\Domains\Banner\BannerRepository;
use App\Http\Requests\Banner\BannerStoreRequest;
use App\Http\Requests\Banner\BannerUpdateRequest;
use App\Support\Traits\CrudController;

class BannerController extends Controller
{
    use CrudController;

    /**
     * @var BannerRepository
     */
    protected $repository;

    /**
     * BannerController constructor.
     * @param BannerRepository $repository
     */
    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(BannerStoreRequest $request)
    {
        return $this->repository->create($request->all());
    }

    public function update(BannerUpdateRequest $request, $id)
    {
        return $this->repository->update($request->all(), $id);
    }
}
