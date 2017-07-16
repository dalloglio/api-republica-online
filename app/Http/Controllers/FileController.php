<?php

namespace App\Http\Controllers;

use App\Domains\File\FileRepository;
use App\Support\Traits\CrudController;

class FileController extends Controller
{
    use CrudController;

    /**
     * @var FileRepository
     */
    protected $repository;

    /**
     * FileController constructor.
     * @param FileRepository $repository
     */
    public function __construct(FileRepository $repository)
    {
        $this->repository = $repository;
    }
}
