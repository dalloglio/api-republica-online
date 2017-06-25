<?php

namespace App\Http\Controllers;

use App\Domains\Category\CategoryRepository;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(CategoryRepository $category)
    {
        $this->category = $category;
    }

    public function index()
    {
        return $this->category->getAll();
    }

    public function store(Request $request)
    {
        return $this->category->create($request->all());
    }

    public function show($id)
    {
        return $this->category->findById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->category->edit($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->category->destroy($id);
    }
}
