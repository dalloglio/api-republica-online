<?php

namespace App\Http\Controllers;

use App\Domains\User\UserRepository;
use App\Events\LoginFacebook;
use App\Http\Requests\UserRequest;
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

    public function register(UserRequest $request)
    {
        $request->merge(['status' => true]);
        return $this->store($request);
    }

    public function facebook(UserRequest $request)
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
            return $this->store($request);
        }
    }
}
