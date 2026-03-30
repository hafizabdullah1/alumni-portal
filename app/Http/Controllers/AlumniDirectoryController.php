<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

class AlumniDirectoryController extends Controller
{
    public function index()
    {
        $alumni = User::select('id', 'name', 'email')
            ->where('role', User::ROLE_ALUMNI)
            ->where('is_verified', true)
            ->with(['alumniProfile:user_id,job_title,company,graduation_year,location'])
            ->orderBy('name')
            ->paginate(12);

        return view('alumni.index', compact('alumni'));
    }
}
