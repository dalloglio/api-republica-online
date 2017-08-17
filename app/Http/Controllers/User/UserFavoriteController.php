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
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = request()->user();
        $favorites = $user->favorites()->with('ad.photo')->get();
        return response()->json($favorites);
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
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = request()->user();
        $favorite = $user->favorites()->find((int) $id);
        if ($favorite) {
            $favorite->delete();
            return response()->json($favorite);
        }
        return response()->json(null, 404);
    }
}
