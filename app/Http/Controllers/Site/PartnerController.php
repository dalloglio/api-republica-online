<?php

namespace App\Http\Controllers\Site;

use App\Domains\Partner\PartnerRepository;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        $random = $request->has('random') ? (bool) $request->random : false;
        $limit = $request->has('limit') ? (int) $request->limit : 20;
        $partners = $this->repository->getAllSite($limit, false, $random);
        return response()->json($partners);
    }
}
