<?php

namespace App\Http\Controllers;

use App\Domains\User\UserRepository;
use Illuminate\Http\Request;

class UserPhotoController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * UserPhotoController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @param $user_id
     * @return mixed
     */
    public function store(Request $request, $user_id)
    {
        return $this->repository->findById((int) $user_id)->photo()->create($request->all());
    }

    /**
     * @param Request $request
     * @param $user_id
     * @param $photo_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $user_id, $photo_id)
    {
        $photo = $this->repository->findById((int) $user_id)->photo()->find((int) $photo_id);
        if ($photo->update($request->all())) {
            return $photo;
        }
        return response()->json(null, 404);
    }
}
