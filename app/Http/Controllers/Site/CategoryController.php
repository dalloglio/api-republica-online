<?php

namespace App\Http\Controllers\Site;

use App\Domains\Category\CategoryRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var CategoryRepository
     */
    protected $repository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if ($request->has('list')) {
            $categories = $this->repository->getListsSite();
        } else {
            $categories = $this->repository->getCategoriesSite(200, false);
        }
        return response()->json($categories);
    }
}
