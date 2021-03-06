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
        $price_min = $request->has('price_min') ? (double) $request->price_min : null;
        $price_max = $request->has('price_max') ? (double) $request->price_max : null;
        $filters = $request->has('filters') ? json_decode($request->filters, true) : null;
        $ads = $this->repository->getAdsSite($limit, $paginate, $order, $category, $uf, $cidade, $price_min, $price_max, $filters);
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

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function prices()
    {
        $prices = $this->repository->getFilterPrices();
        return response()->json($prices);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function categories()
    {
        $categories = $this->repository->getFilterCategories();
        return response()->json($categories);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function states()
    {
        $states = $this->repository->getFilterStates();
        return response()->json($states);
    }

    /**
     * @param int $state_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function states_cities($state_id)
    {
        $cities = $this->repository->getFilterStateCities((int) $state_id);
        return response()->json($cities);
    }
}
