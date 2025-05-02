<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    public function uploadToLocal(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = $request->file('document')->store('uploads', 'public');

        return response()->json(['path' => $path], 200);
    }

    public function getFromLocal($filename)
    {
        $path = storage_path("app/public/uploads/{$filename}");

        if (file_exists($path)) {
            return response()->file($path);
        }

        return response()->json(['message' => 'File not found.'], 404);
    }

    public function uploadToMinio(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $image = $request->file('image');
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

        // Store the image in the 'uploads' directory on the MinIO disk
        $path = $image->storeAs('uploads', $fileName, 'minio');

        return response()->json([
            'path' => $path,
        ], 200);
    }


    public function getFromMinio($filename)
    {
        $path = "uploads/{$filename}";

        if (Storage::disk('minio')->exists($path)) {
            $file = Storage::disk('minio')->get($path);
            $mime = Storage::disk('minio')->mimeType($path);
            return response($file)->header('Content-Type', $mime);
        }
        return response()->json(['message' => 'File not found in MinIO.'], 404);
    }
}
