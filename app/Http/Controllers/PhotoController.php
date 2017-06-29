<?php

namespace App\Http\Controllers;

use App\Domains\Photo\PhotoRepository;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    protected $photo;

    public function __construct(PhotoRepository $photo)
    {
        $this->photo = $photo;
    }

    public function index()
    {
        return $this->photo->getAll();
    }

    public function store(Request $request)
    {
        return $this->photo->create($request->all());
    }

    public function show($id)
    {
        return $this->photo->findById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->photo->edit($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->photo->destroy($id);
    }
}
