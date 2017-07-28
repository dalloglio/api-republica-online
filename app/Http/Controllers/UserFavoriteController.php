<?php

namespace App\Http\Controllers;

use App\Domains\User\UserRepository;
use Illuminate\Http\Request;

class UserFavoriteController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * UserFavoriteController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function index($user_id)
    {
        return $this->repository->findById((int) $user_id)->favorites;
    }

    /**
     * @param Request $request
     * @param $user_id
     * @return mixed
     */
    public function store(Request $request, $user_id)
    {
        return $this->repository->findById((int) $user_id)->favorites()->create($request->all());
    }

    /**
     * @param $user_id
     * @param $favorite_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($user_id, $favorite_id)
    {
        $favorite = $this->repository->findById((int) $user_id)->favorites()->find((int) $favorite_id);
        if ($favorite) {
            $favorite->delete();
            return $favorite;
        }
        return response()->json(null, 404);
    }
}
