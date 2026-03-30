<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }

        if ($user->isAlumni() && !$user->is_verified) {
            return redirect()->route('alumni.pending');
        }

        return view('dashboard');
    }
}
