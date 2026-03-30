<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\JobPosting;
use App\Http\Requests\JobPostingRequest;
use Illuminate\Support\Facades\Auth;

class JobPostingController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPosting::where('is_active', true)->with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('company', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        $jobs = $query->latest()->paginate(10);

        return view('jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('jobs.create');
    }

    public function store(JobPostingRequest $request)
    {
        // Only verified alumni can post jobs (Middleware handles this, but good to be explicit in plan)
        $request->user()->jobPostings()->create($request->validated());

        return redirect()->route('jobs.index')->with('status', 'Job posted successfully!');
    }

    public function destroy(JobPosting $jobPosting)
    {
        // Only owner or admin can delete
        if (Auth::user()->id !== $jobPosting->user_id && !Auth::user()->isAdmin()) {
            abort(403);
        }

        $jobPosting->delete();

        return back()->with('status', 'Job deleted successfully!');
    }
}
