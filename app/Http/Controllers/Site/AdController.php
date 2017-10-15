<?php

namespace App\Http\Controllers\Site;

use App\Domains\Ad\AdRepository;
use Illuminate\Http\Request;

class AdController
{
    /**
     * @var AdRepository
     */
    protected $repository;

    /**
     * AdController constructor.
     * @param AdRepository $repository
     */
    public function __construct(AdRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function latest(Request $request)
    {
        $random = $request->has('random') ? (bool) $request->random : false;
        $paginate = $request->has('paginate') ? (bool) $request->paginate : false;
        $limit = $request->has('limit') ? (int) $request->limit : 4;
        $ads = $this->repository->getLatestAds($limit, $paginate, $random);
        return response()->json($ads);
    }
}
