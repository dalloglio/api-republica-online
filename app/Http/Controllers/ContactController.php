<?php

namespace App\Http\Controllers;

use App\Domains\Contact\ContactRepository;
use App\Support\Traits\CrudController;

class ContactController extends Controller
{
    use CrudController;

    /**
     * @var ContactRepository
     */
    protected $repository;

    /**
     * ContactController constructor.
     * @param ContactRepository $repository
     */
    public function __construct(ContactRepository $repository)
    {
        $this->repository = $repository;
    }
}
