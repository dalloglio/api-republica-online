<?php

namespace App\Http\Controllers\User;

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
        dd($user);
    }
}
