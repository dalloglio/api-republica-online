<?php

namespace App\Http\Controllers\User;

use App\Domains\Ad\Ad;
use App\Domains\Ad\AdRepository;
use App\Http\Requests\Ad\AdStoreRequest;
use App\Http\Requests\Ad\AdUpdateRequest;
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
    public function show($ad_id)
    {
        $user = request()->user();
        $ad = $user->ads()->find((int) $ad_id);
        if ($ad) {
            $ad->address;
            $ad->photo;
            $ad->photos;
            $ad->details;
            $ad->contact;
            return response()->json($ad);
        }
        return response()->json(null, 404);
    }

    /**
     * @param AdStoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(AdStoreRequest $request)
    {
        $user = $request->user();
        $ad = $user->ads()->create($request->all());
        return response()->json($ad);
    }

    /**
     * @param AdUpdateRequest $request
     * @param int $ad_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(AdUpdateRequest $request, $ad_id)
    {
        $user = $request->user();
        $ad = $user->ads()->find((int) $ad_id);
        if ($ad->update($request->all())) {
            return response()->json($ad);
        }
        return response()->json(null, 404);
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
