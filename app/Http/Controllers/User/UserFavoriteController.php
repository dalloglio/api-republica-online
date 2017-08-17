<?php

namespace App\Http\Controllers\User;

use App\Domains\Ad\Ad;
use App\Domains\User\UserRepository;
use App\Http\Controllers\Controller;
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $user = request()->user();
        $ad = Ad::find((int) $request->ad_id);
        if (!$ad) {
            return response()->json(['message' => 'Anúncio não encontrado.'], 400);
        }
        if ($user->favorites()->where('ad_id', $ad->id)->exists()) {
            return response()->json(['message' => 'Você já favoritou este anúncio.'], 200);
        }
        $favorite = $user->favorites()->create(['ad_id' => $ad->id]);
        return response()->json($favorite, 201);
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
