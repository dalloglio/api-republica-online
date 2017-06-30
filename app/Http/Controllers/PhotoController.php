<?php

namespace App\Http\Controllers;

use App\Domains\Photo\PhotoRepository;
use App\Support\Traits\CrudController;

class PhotoController extends Controller
{
    use CrudController;
    
    protected $repository;

    public function __construct(PhotoRepository $repository)
    {
        $this->repository = $repository;
    }
}
