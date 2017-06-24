<?php

namespace App\Http\Controllers;

use App\Domains\Address\AddressRepository;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    protected $address;

    public function __construct(AddressRepository $address)
    {
        $this->address = $address;
    }

    public function index()
    {
        return $this->address->getAll();
    }

    public function store(Request $request)
    {
        return $this->address->create($request->all());
    }

    public function show($id)
    {
        return $this->address->findById($id);
    }

    public function update(Request $request, $id)
    {
        return $this->address->edit($request->all(), $id);
    }

    public function destroy($id)
    {
        return $this->address->destroy($id);
    }
}
