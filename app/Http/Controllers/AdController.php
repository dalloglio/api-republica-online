<?php

namespace App\Http\Controllers;

use App\Domains\Ad\AdRepository;
use App\Support\Traits\CrudController;

class AdController extends Controller
{
    use CrudController;

    protected $repository;

    public function __construct(AdRepository $repository)
    {
        $this->repository = $repository;
    }
}
