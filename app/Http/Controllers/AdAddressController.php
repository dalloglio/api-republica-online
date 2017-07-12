<?php

namespace App\Http\Controllers;

use App\Domains\Ad\AdRepository;
use Illuminate\Http\Request;

class AdAddressController extends Controller
{
    protected $repository;

    public function __construct(AdRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($ad_id)
    {
        return $this->repository->findById((int) $ad_id)->address;
    }

    public function store(Request $request, $ad_id)
    {
        return $this->repository->findById((int) $ad_id)->address()->create($request->all());
    }

    public function show($ad_id, $address_id)
    {
        $ad = $this->repository->findById((int) $ad_id);
        if ($ad->address->id === (int) $address_id) {
            return $ad->address;
        }
        return [];
    }

    public function update(Request $request, $ad_id, $address_id)
    {
        $ad = $this->repository->findById((int) $ad_id);
        if ($ad->address->id === (int) $address_id) {
            $ad->address()->update($request->all());
        }
        return $ad->address;
    }

    public function destroy($ad_id, $address_id)
    {
        $ad = $this->repository->findById((int) $ad_id);
        if ($ad->address && $ad->address->id === (int) $address_id) {
            $ad->address->delete();
        }
        return $ad->address;
    }
}
