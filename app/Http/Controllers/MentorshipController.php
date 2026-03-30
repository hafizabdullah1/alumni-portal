<?php

namespace App\Http\Controllers;

use App\Models\MentorshipRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorshipController extends Controller
{
    public function store(Request $request, User $alumni)
    {
        MentorshipRequest::create([
            'student_id' => Auth::id(),
            'alumni_id' => $alumni->id,
            'message' => $request->message,
        ]);

        return back()->with('status', 'Mentorship request sent successfully!');
    }

    public function index()
    {
        $requests = Auth::user()->mentorshipRequests()->with('student')->latest()->get();
        return view('alumni.mentorship.index', compact('requests'));
    }

    public function update(Request $request, MentorshipRequest $mentorshipRequest)
    {
        $mentorshipRequest->update(['status' => $request->status]);
        return back()->with('status', 'Request ' . $request->status);
    }
}
