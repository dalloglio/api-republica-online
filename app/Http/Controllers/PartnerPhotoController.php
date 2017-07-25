<?php

namespace App\Http\Controllers;

use App\Domains\Partner\PartnerRepository;
use Illuminate\Http\Request;

class PartnerPhotoController extends Controller
{
    /**
     * @var PartnerRepository
     */
    protected $repository;

    /**
     * PartnerPhotoController constructor.
     * @param PartnerRepository $repository
     */
    public function __construct(PartnerRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param $partner_id
     * @return mixed
     */
    public function store(Request $request, $partner_id)
    {
        return $this->repository->findById((int) $partner_id)->photo()->create($request->all());
    }

    /**
     * @param Request $request
     * @param $partner_id
     * @param $photo_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $partner_id, $photo_id)
    {
        $photo = $this->repository->findById((int) $partner_id)->photo()->find((int) $photo_id);
        if ($photo->update($request->all())) {
            return $photo;
        }
        return response()->json(null, 404);
    }
}
