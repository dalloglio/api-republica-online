<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\UpdatePasswordRequest;

use App\Domains\User\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * UserController constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $user->address;
        $user->photo;
        return response()->json($user);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $user = $request->user();
        if ($user->update($request->except('photo'))) {
            return response()->json($user);
        }
        return response()->json(['message' => 'Não foi possível salvar.'], 400);
    }

    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $request->user();
        $user->password = $request->password;
        if ($user->save()) {
            return response()->json(null);
        }
        return response()->json(['message' => 'Não foi possível salvar a senha.'], 400);
    }

    public function updatePhoto(Request $request)
    {
        $user = $request->user();
        $photo = $user->photo;
        if ($photo) {
            if ($photo->update($request->all())) {
                return $photo;
            }
        } else {
            $photo = $user->photo()->create($request->all());
            return $photo;
        }
        return response()->json(null, 404);
    }
}
