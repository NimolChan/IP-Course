<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class UploadController extends Controller
{
    // 1. Upload to local storage
    public function uploadToLocal(Request $request)
    {
        $request->validate([
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = $request->file('document')->store('uploads', 'public');

        return response()->json(['path' => $path], 200);
    }

    // 2. Get file from local storage
    public function getFromLocal($filename)
    {
        $path = storage_path("app/public/uploads/{$filename}");

        if (file_exists($path)) {
            return response()->file($path);
        }

        return response()->json(['message' => 'File not found.'], 404);
    }

    // 3. Upload to MinIO
    public function uploadToMinio(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $image = $request->file('image');
        $fileName = uniqid() . '.' . $image->getClientOriginalExtension();

        $path = $image->storeAs('uploads', $fileName, 'minio');

        return response()->json(['path' => $path], 200);
    }

    // 4. Get file from MinIO
    public function getFromMinio($filename)
    {
        $path = "uploads/{$filename}";

        if (Storage::disk('minio')->exists($path)) {
            $file = Storage::disk('minio')->get($path);
            $mime = \Symfony\Component\Mime\MimeTypes::getDefault()->guessMimeType($path);
            return response($file)->header('Content-Type', $mime);
        }

        return response()->json(['message' => 'File not found in MinIO.'], 404);
    }

    // 5. Upload to MinIO and create thumbnail in local storage
    public function uploadToMinioWithThumbnail(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048',
        ]);

        $file = $request->file('image');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

        // Save original to MinIO
        $minioPath = $file->storeAs('uploads', $fileName, 'minio');
        $minioUrl = Storage::disk('minio')->url($minioPath);

        // Save copy to local public disk
        $localPath = $file->storeAs('uploads', $fileName, 'public');

        // Generate thumbnail using Intervention Image
        $thumbnailImage = Image::make($file->getRealPath());
        $thumbnailImage->resize(200, 200, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $thumbnailFileName = 'thumb_' . $fileName;
        $thumbnailPath = 'thumbnails/' . $thumbnailFileName;

        // Save thumbnail to public disk
        Storage::disk('public')->put($thumbnailPath, (string) $thumbnailImage->encode());

        return response()->json([
            'minio_path'     => $minioPath,
            'minio_url'      => $minioUrl,
            'local_path'     => $localPath,
            'thumbnail_path' => $thumbnailPath,
        ], 201);
    }
}
