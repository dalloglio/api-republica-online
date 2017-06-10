<?php

namespace App\Http\Controllers;

use App\Domains\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    protected $users;

    public function __construct(UsersRepository $users)
    {
        $this->users = $users;
    }

    public function index()
    {
        return $this->users->getAll();
    }

    public function store(Request $request)
    {
        return $this->users->create($request->all());
    }

    public function show($id)
    {
        return $this->users->findById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->users->edit($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->users->destroy($id);
    }
}
