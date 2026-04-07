<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentServicesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $results = $user->examResults()->latest()->get();
        $personalFiles = $user->fileTracks()->latest()->get();
        $globalFiles = \App\Models\FileTrack::where('is_global', true)->latest()->get();
        
        return view('student.services', compact('results', 'personalFiles', 'globalFiles'));
    }

    public function downloadFile($id)
    {
        $file = \App\Models\FileTrack::findOrFail($id);
        
        // Security check: Only allow download if it's a global file or belongs to the authenticated user
        if (!$file->isGlobal() && $file->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access to this file.');
        }

        if (!\Illuminate\Support\Facades\Storage::disk('local')->exists($file->file_path)) {
            abort(404, 'File not found on the server.');
        }

        return \Illuminate\Support\Facades\Storage::disk('local')->download($file->file_path, $file->title . '.' . pathinfo($file->file_path, PATHINFO_EXTENSION));
    }
}
