<?php

namespace App\Http\Controllers;

use App\Domains\User\UserRepository;
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

    public function register(Request $request)
    {
        $request->merge(['status' => true]);
        return $this->store($request);
    }

    public function facebook(Request $request)
    {
        $user = $this->repository->userExists($request->email);
        if ($user) {
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
