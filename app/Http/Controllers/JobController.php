<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = Job::where('is_active', true)->latest('created_at');

        if ($request->filled('q')) {
            $q = '%' . $request->input('q') . '%';
            $query->where(fn($s) => $s->where('title', 'like', $q)->orWhere('company_name', 'like', $q));
        }

        $jobs = $query->paginate(12)->withQueryString();

        return view('careers.index', compact('jobs'));
    }

    public function show($slug)
    {
        $job = Job::with('poster')->where('slug', $slug)->firstOrFail();

        // optionally increment view count here (if you have field)
        return view('careers.show', compact('job'));
    }
}
