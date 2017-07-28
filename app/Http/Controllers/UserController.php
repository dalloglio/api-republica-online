<?php

namespace App\Http\Controllers;

use App\Domains\User\UserRepository;
use App\Support\Traits\CrudController;

class UserController extends Controller
{
    use CrudController;
    
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }
}
