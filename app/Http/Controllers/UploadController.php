<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function upload(Request $request): JsonResponse
    {
        $data = $request->validate([
            'dirName' => 'required|string|max:255'
        ]);
        $path = public_path('images/uploads/'.$data['dirName']);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('image');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json(['path' => '/images/uploads/'.$data['dirName'].'/'.$name]);
    }
}
