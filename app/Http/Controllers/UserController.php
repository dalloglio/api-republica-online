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
}
