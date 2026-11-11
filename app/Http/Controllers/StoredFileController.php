<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StoredFileController extends Controller
{
    public function show($type, $filename)
    {
        $allowed = ['products', 'logos'];
        if (! in_array($type, $allowed)) {
            abort(404);
        }

        $filename = basename($filename); // prevent path traversal
        $path = storage_path('app/public/' . $type . '/' . $filename);

        if (! file_exists($path)) {
            abort(404);
        }

        $mime = mime_content_type($path) ?: 'application/octet-stream';

        return response()->file($path, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=31536000',
        ]);
    }
}