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
        $files = $user->fileTracks()->latest()->get();
        
        return view('student.services', compact('results', 'files'));
    }
}
