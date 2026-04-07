<?php

namespace App\Http\Controllers;

use App\Models\FileTrack;
use App\Models\ExamResult;
use App\Models\User;
use Illuminate\Http\Request;

class AdministrativeController extends Controller
{
    // File Tracking
    public function indexFiles()
    {
        $files = FileTrack::with('user')->latest()->paginate(15);
        return view('admin.files.index', compact('files'));
    }

    public function createFile()
    {
        $users = User::all();
        return view('admin.files.create', compact('users'));
    }

    public function storeFile(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'title' => 'required',
            'document' => 'required|file|mimes:pdf,doc,docx,jpg,png,zip|max:10240', // 10MB limit
        ]);

        $is_global = $request->user_id === 'global';
        $user_id = $is_global ? null : $request->user_id;

        // Store file securely in storage/app/documents
        $path = $request->file('document')->store('documents', 'local');

        FileTrack::create([
            'user_id' => $user_id,
            'file_path' => $path,
            'title' => $request->title,
            'description' => $request->description,
            'is_global' => $is_global,
        ]);

        return redirect()->route('admin.files.index')->with('status', 'File uploaded successfully.');
    }

    public function updateFile(Request $request, FileTrack $file)
    {
        // For deleting files to re-claim space
        if ($request->has('delete')) {
            \Illuminate\Support\Facades\Storage::disk('local')->delete($file->file_path);
            $file->delete();
            return back()->with('status', 'File deleted.');
        }
        return back();
    }

    // Exam Results
    public function indexResults()
    {
        $results = ExamResult::with('user')->latest()->paginate(15);
        return view('admin.results.index', compact('results'));
    }

    public function createResult()
    {
        $students = User::where('role', 'student')->get();
        return view('admin.results.create', compact('students'));
    }

    public function storeResult(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'semester' => 'required',
            'subject' => 'required',
            'grade' => 'required'
        ]);

        ExamResult::create($request->all());
        return redirect()->route('admin.results.index')->with('status', 'Exam result uploaded.');
    }
}
