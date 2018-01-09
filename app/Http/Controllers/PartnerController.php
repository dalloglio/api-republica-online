<?php

namespace App\Http\Controllers;

use App\Domains\Partner\PartnerRepository;
use App\Http\Requests\Partner\PartnerStoreRequest;
use App\Http\Requests\Partner\PartnerUpdateRequest;
use App\Support\Traits\CrudController;

class PartnerController extends Controller
{
    use CrudController;

    /**
     * @var PartnerRepository
     */
    protected $repository;

    /**
     * PartnerController constructor.
     * @param PartnerRepository $repository
     */
    public function __construct(PartnerRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(PartnerStoreRequest $request)
    {
        return $this->repository->create($request->all());
    }

    public function update(PartnerUpdateRequest $request, $id)
    {
        return $this->repository->update($request->all(), $id);
    }
}
