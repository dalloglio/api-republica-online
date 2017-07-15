<?php

namespace App\Http\Controllers;

use App\Domains\Ad\AdRepository;
use Illuminate\Http\Request;

class AdPhotoController extends Controller
{
    protected $repository;

    public function __construct(AdRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($ad_id)
    {
        return $this->repository->findById((int) $ad_id)->photos;
    }

    public function store(Request $request, $ad_id)
    {
        return $this->repository->findById((int) $ad_id)->photos()->create($request->all());
    }

    public function show($ad_id, $photo_id)
    {
        return $this->repository->findById((int) $ad_id)->photo()->find((int) $photo_id);
    }

    public function update(Request $request, $ad_id, $photo_id)
    {
        $photo = $this->repository->findById((int) $ad_id)->photo()->find((int) $photo_id);
        if ($photo->update($request->all())) {
            return $photo;
        }
        return response()->json(null, 404);
    }

    public function destroy($ad_id, $photo_id)
    {
        $ad = $this->repository->findById((int) $ad_id);
        if ($ad->photo) {
            $photo = $ad->photo->find((int) $photo_id);
            if ($photo) {
                $photo->delete();
                return $photo;
            }
        }
        return response()->json(null, 404);
    }
}
