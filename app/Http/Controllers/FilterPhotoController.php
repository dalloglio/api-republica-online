<?php

namespace App\Http\Controllers;

use App\Domains\Filter\FilterRepository;
use Illuminate\Http\Request;

class FilterPhotoController extends Controller
{
    /**
     * @var FilterRepository
     */
    protected $repository;

    /**
     * FilterPhotoController constructor.
     * @param FilterRepository $repository
     */
    public function __construct(FilterRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param $filter_id
     * @return mixed
     */
    public function store(Request $request, $filter_id)
    {
        return $this->repository->findById((int) $filter_id)->photo()->create($request->all());
    }

    /**
     * @param Request $request
     * @param $filter_id
     * @param $photo_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $filter_id, $photo_id)
    {
        $photo = $this->repository->findById((int) $filter_id)->photo()->find((int) $photo_id);
        if ($photo->update($request->all())) {
            return $photo;
        }
        return response()->json(null, 404);
    }
}
