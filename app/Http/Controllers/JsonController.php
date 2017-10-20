<?php

namespace App\Http\Controllers;

class JsonController extends Controller
{
    public function estados()
    {
        $path = public_path('json/estados.json');
        if (file_exists($path)) {
            $json = json_decode(file_get_contents($path));
            return response()->json($json);
        }
        return response()->json(null, 404);
    }

    public function cidades()
    {
        $path = public_path('json/cidades.json');
        if (file_exists($path)) {
            $json = json_decode(file_get_contents($path));
            return response()->json($json);
        }
        return response()->json(null, 404);
    }
}
