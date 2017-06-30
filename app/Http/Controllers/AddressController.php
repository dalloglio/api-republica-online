<?php

namespace App\Http\Controllers;

use App\Domains\Address\AddressRepository;
use App\Support\Traits\CrudController;

class AddressController extends Controller
{
    use CrudController;

    protected $repository;

    public function __construct(AddressRepository $repository)
    {
        $this->repository = $repository;
    }
}
