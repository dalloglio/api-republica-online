<?php

namespace App\Http\Controllers;

use App\Domains\User\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $user;

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        return $this->user->getAll();
    }

    public function store(Request $request)
    {
        return $this->user->create($request->all());
    }

    public function show($id)
    {
        return $this->user->findById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->user->edit($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->user->destroy($id);
    }
}
