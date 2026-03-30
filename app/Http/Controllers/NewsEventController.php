<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\NewsEvent;
use App\Http\Requests\NewsEventRequest;
use Illuminate\Support\Facades\Auth;

class NewsEventController extends Controller
{
    public function index()
    {
        $newsEvents = NewsEvent::where('is_public', true)
            ->with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('news.index', compact('newsEvents'));
    }

    public function create()
    {
        // Handled by AdminMiddleware in routes
        return view('news.create');
    }

    public function store(NewsEventRequest $request)
    {
        $request->user()->newsEvents()->create($request->validated());

        return redirect()->route('news.index')->with('status', 'Article published successfully!');
    }

    public function destroy(NewsEvent $newsEvent)
    {
        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        $newsEvent->delete();

        return back()->with('status', 'Article deleted successfully!');
    }
}
