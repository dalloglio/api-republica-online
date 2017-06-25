<?php

namespace App\Http\Controllers;

use App\Domains\Ad\AdRepository;
use Illuminate\Http\Request;

class AdController extends Controller
{
    protected $ad;

    public function __construct(AdRepository $ad)
    {
        $this->ad = $ad;
    }

    public function index()
    {
        return $this->ad->getAll();
    }

    public function store(Request $request)
    {
        return $this->ad->create($request->all());
    }

    public function show($id)
    {
        return $this->ad->findById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->ad->edit($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->ad->destroy($id);
    }
}
