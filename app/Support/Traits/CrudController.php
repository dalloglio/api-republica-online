<?php

namespace App\Support\Traits;

use Illuminate\Http\Request;

trait CrudController
{
    public function index()
    {
        return $this->repository->getAll();
    }

    public function store(Request $request)
    {
        return $this->repository->create($request->all());
    }

    public function show($id)
    {
        return $this->repository->findById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->repository->edit($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->repository->destroy($id);
    }
}
