<?php

namespace App\Http\Controllers;

use App\Domains\Photo\PhotoRepository;
use App\Support\Traits\CrudController;
use Storage;

class PhotoController extends Controller
{
    use CrudController;
    
    protected $repository;

    public function __construct(PhotoRepository $repository)
    {
        $this->repository = $repository;
    }

    public function photo($id)
    {
        $photo = $this->repository->findById((int) $id);
        if (Storage::disk($photo->disk)->exists($photo->photo)) {
        	return response()->file(storage_path($photo->url));
        }
    }
}
