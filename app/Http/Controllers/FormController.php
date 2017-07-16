<?php

namespace App\Http\Controllers;

use App\Domains\Form\FormRepository;
use App\Support\Traits\CrudController;

class FormController extends Controller
{
    use CrudController;

    /**
     * @var FormRepository
     */
    protected $repository;

    /**
     * FormController constructor.
     * @param FormRepository $repository
     */
    public function __construct(FormRepository $repository)
    {
        $this->repository = $repository;
    }
}
