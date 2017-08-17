<?php

namespace App\Http\Controllers\User;

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
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $ads = $this->repository->getAdsByUser($request->user()->id);
        return response()->json($ads);
    }

    /**
     * @param int $ad_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($ad_id)
    {
        $user = request()->user();
        $ad = $user->ads()->find((int) $ad_id);
        if ($ad) {
            if ($ad->delete()) {
                return response()->json($ad);
            }
        }
        return response()->json(null, 404);
    }
}