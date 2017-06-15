<?php

namespace App\Http\Controllers;

use App\Domains\Ads\AdRepository;
use Illuminate\Http\Request;

class AdController extends Controller
{
    protected $ads;

    public function __construct(AdRepository $ads)
    {
        $this->ads = $ads;
    }

    public function index()
    {
        return $this->ads->getAll();
    }

    public function store(Request $request)
    {
        return $this->ads->create($request->all());
    }

    public function show($id)
    {
        return $this->ads->findById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->ads->edit($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->ads->destroy($id);
    }
}
