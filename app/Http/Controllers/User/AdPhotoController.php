<?php

namespace App\Http\Controllers\User;

use App\Domains\Ad\Ad;
use App\Domains\Photo\Photo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdPhotoController extends Controller
{
    public function index(Ad $ad)
    {
        $photos = $ad->photos;
        return response()->json($photos);
    }

    public function store(Request $request, Ad $ad)
    {
        $photo = $ad->photos()->create($request->all());
        return response()->json($photo);
    }

    public function show(Ad $ad, Photo $photo)
    {
        return response()->json($photo);
    }

    public function update(Request $request, Ad $ad, Photo $photo)
    {
        $photo->update($request->all());
        return response()->json($photo);
    }

    public function destroy(Ad $ad, Photo $photo)
    {
        $photo->delete();
        return response()->json($photo);
    }
}
