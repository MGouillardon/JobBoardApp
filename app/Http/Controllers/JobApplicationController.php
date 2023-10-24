<?php

namespace App\Http\Controllers;

use App\Http\Requests\Job\JobApplicationRequest;
use App\Models\Job;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(Job $job)
    {
        $this->authorize('apply', $job);
        return view('job_application.create',[
            'job' => $job,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Job $job, JobApplicationRequest $request)
    {
        $requestValidated = $request->validated();

        $file = $request->file('cv');
        $path = $file->store('cvs', 'private');


        $job->jobApplications()->create([
            'user_id' => $request->user()->id,
            'expected_salary' => $requestValidated['expected_salary'],
            'cv_path' => $path,
        ]);

        return redirect()->route('jobs.show', $job)->with('success', 'You have successfully applied for this job.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
