<?php

namespace App\Http\Controllers\Site;

use App\Domains\Partner\PartnerRepository;

class PartnerController
{
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $partners = $this->repository->getAll(6, false);
        return response()->json($partners);
    }
}