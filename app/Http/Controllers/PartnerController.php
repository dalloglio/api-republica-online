<?php

namespace App\Http\Controllers;

use App\Domains\Partner\PartnerRepository;
use App\Support\Traits\CrudController;

class PartnerController extends Controller
{
    use CrudController;

    /**
     * @var PartnerRepository
     */
    protected $repository;

    /**
     * PartnerController constructor.
     * @param PartnerRepository $repository
     */
    public function __construct(PartnerRepository $repository)
    {
        $this->repository = $repository;
    }
}
