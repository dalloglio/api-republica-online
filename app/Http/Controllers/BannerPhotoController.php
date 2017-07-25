<?php

namespace App\Http\Controllers;

use App\Domains\Banner\BannerRepository;
use Illuminate\Http\Request;

class BannerPhotoController extends Controller
{
    /**
     * @var BannerRepository
     */
    protected $repository;

    /**
     * BannerPhotoController constructor.
     * @param BannerRepository $repository
     */
    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param $banner_id
     * @return mixed
     */
    public function store(Request $request, $banner_id)
    {
        return $this->repository->findById((int) $banner_id)->photo()->create($request->all());
    }

    /**
     * @param Request $request
     * @param $banner_id
     * @param $photo_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $banner_id, $photo_id)
    {
        $photo = $this->repository->findById((int) $banner_id)->photo()->find((int) $photo_id);
        if ($photo->update($request->all())) {
            return $photo;
        }
        return response()->json(null, 404);
    }
}
