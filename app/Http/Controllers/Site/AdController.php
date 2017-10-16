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
     * @param int $ad_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($ad_id)
    {
        $ad = $this->repository->getAdSite((int) $ad_id);
        return response()->json($ad);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function latest(Request $request)
    {
        $paginate = $request->has('paginate') ? (bool) $request->paginate : false;
        $limit = $request->has('limit') ? (int) $request->limit : 4;
        $ads = $this->repository->getLatestAds($limit, $paginate);
        return response()->json($ads);
    }
}
