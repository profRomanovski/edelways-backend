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
    public function uploadImage(Request $request): JsonResponse
    {
        return $this->upload($request, 'image', 'images');
    }

    public function uploadFile(Request $request): JsonResponse
    {
        return $this->upload($request, 'file', 'files');
    }

    public function upload(Request $request, $fileField, $mainDirName): JsonResponse
    {
        $data = $request->validate([
            'dirName' => 'required|string|max:255'
        ]);
        $path = public_path($mainDirName.'/uploads/'.$data['dirName']);

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file($fileField);

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'path' => '/'.$mainDirName.'/uploads/'.$data['dirName'].'/'.$name,
            'name' => $file->getClientOriginalName()
        ]);
    }
}
