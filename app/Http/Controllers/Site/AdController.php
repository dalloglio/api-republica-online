<?php

namespace App\Http\Controllers\Site;

use App\Domains\Ad\AdRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdController extends Controller
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
    public function index(Request $request)
    {
        $paginate = $request->has('paginate') ? (bool) $request->paginate : true;
        $limit = $request->has('limit') ? (int) $request->limit : 24;
        $order = $request->has('order') ? $request->order : 'latest';
        $category = $request->has('category') ? (int) $request->category : null;
        $uf = $request->has('uf') ? $request->uf : null;
        $cidade = $request->has('cidade') ? $request->cidade : null;
        $filters = $request->has('filters') ? json_decode($request->filters, true) : null;
        $ads = $this->repository->getAdsSite($limit, $paginate, $order, $category, $uf, $cidade, $filters);
        return response()->json($ads);
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
        $ads = $this->repository->getAdsSite($limit, $paginate);
        return response()->json($ads);
    }
}
