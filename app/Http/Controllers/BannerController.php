<?php

namespace App\Http\Controllers;

use App\Domains\Banner\BannerRepository;
use App\Support\Traits\CrudController;

class BannerController extends Controller
{
    use CrudController;

    /**
     * @var BannerRepository
     */
    protected $repository;

    /**
     * BannerController constructor.
     * @param BannerRepository $repository
     */
    public function __construct(BannerRepository $repository)
    {
        $this->repository = $repository;
    }
}
