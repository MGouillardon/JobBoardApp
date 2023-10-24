<?php

namespace App\Http\Controllers;

use App\Http\Requests\Employer\EmployerRequest;
use Illuminate\Http\Request;

class EmployerController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Employer::class, 'employer');
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployerRequest $request)
    {
        auth()->user()->employer()->create($request->validated());

        return redirect()->route('jobs.index')
            ->with('success', 'Your employer profile has been created successfully.');
    }
}
