<?php

namespace App\Http\Controllers;

use App\Domains\User\UserRepository;
use App\Events\LoginFacebook;
use App\Http\Requests\User\UserRegisterRequest;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Support\Traits\CrudController;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use CrudController;

    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function store(UserStoreRequest $request)
    {
        return $this->repository->create($request->all());
    }

    public function update(UserUpdateRequest $request, $id)
    {
        return $this->repository->update($request->all(), $id);
    }

    public function register(UserRegisterRequest $request)
    {
        $request->merge(['status' => true]);
        return $this->repository->create($request->all());
    }

    public function facebook(UserRegisterRequest $request)
    {
        $user = $this->repository->userExists($request->email);
        if ($user) {
            event(new LoginFacebook($user, $request));
            return $user;
        } else {
            $user = [
                'name' => $request->name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'password' => $request->id,
                'gender' => $request->gender,
                'facebook_id' => $request->id,
                'facebook_picture' => $request->picture['data']['url'],
                'status' => true
            ];
            unset($request['id']);
            $request->merge($user);
            return $this->repository->create($request->all());
        }
    }
}
