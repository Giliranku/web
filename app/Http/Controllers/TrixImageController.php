<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TrixImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120', // 5MB max
        ]);

        $file = $request->file('file');
        $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('trix_uploads', $filename, 'public');

        return response()->json([
            'url' => asset('storage/' . $path)
        ]);
    }

    public function destroy(Request $request)
    {
        $url = $request->input('url');
        
        // Extract path from URL
        $path = str_replace(asset('storage/'), '', $url);
        
        // Only delete if it's a trix upload
        if (str_starts_with($path, 'trix_uploads/')) {
            Storage::disk('public')->delete($path);
        }

        return response()->json(['success' => true]);
    }
}
