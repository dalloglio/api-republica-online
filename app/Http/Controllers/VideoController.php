<?php

namespace App\Http\Controllers;

use App\Domains\Video\VideoRepository;
use App\Support\Traits\CrudController;

class VideoController extends Controller
{
    use CrudController;

    protected $repository;

    public function __construct(VideoRepository $repository)
    {
        $this->repository = $repository;
    }
}
