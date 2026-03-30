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
            'user_id' => 'required|exists:users,id',
            'file_no' => 'required|unique:file_tracks',
            'title' => 'required',
            'current_deparment' => 'required',
            'status' => 'required'
        ]);

        FileTrack::create($request->all());
        return redirect()->route('admin.files.index')->with('status', 'File tracking record created.');
    }

    public function updateFile(Request $request, FileTrack $file)
    {
        $file->update($request->only(['current_deparment', 'status', 'remarks']));
        return back()->with('status', 'File updated.');
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
