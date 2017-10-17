<?php

namespace App\Http\Controllers\Site;

use App\Domains\Banner\BannerRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BannerController extends Controller
{
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $size = $request->has('size') ? $request->size : '';
        $random = $request->has('random') ? (bool) $request->random : true;
        $limit = $request->has('limit') ? (int) $request->limit : 1;
        $banners = $this->repository->getBannersBySize($size, $random, $limit);
        return response()->json($banners);
    }
}
