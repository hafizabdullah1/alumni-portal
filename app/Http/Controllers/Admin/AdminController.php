<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $pendingUsers = User::where('role', User::ROLE_ALUMNI)
                            ->where('is_verified', false)
                            ->orderBy('created_at', 'desc')
                            ->get();

        $stats = [
            'totalAlumni' => User::where('role', User::ROLE_ALUMNI)->count(),
            'pendingAlumni' => $pendingUsers->count(),
            'totalStudents' => User::where('role', User::ROLE_STUDENT)->count(),
        ];

        return view('admin.dashboard', array_merge(compact('pendingUsers'), $stats));
    }

    public function verify(User $user)
    {
        $user->update(['is_verified' => true]);

        return redirect()->back()->with('status', 'User verified successfully.');
    }
}
