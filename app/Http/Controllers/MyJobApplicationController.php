<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;

class MyJobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('my_job_applications.index', [
            'applications' => auth()->user()->jobApplications()
                ->with([
                    'job' => fn($query) => $query
                        ->withCount('jobApplications')
                        ->withAvg('jobApplications', 'expected_salary')
                        ->withTrashed(),
                    'job.employer'
                ])->latest()->paginate(3)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobApplication $myJobApplication)
    {
        $myJobApplication->delete();

        return redirect()->route('my-job-applications.index')
            ->with('success', 'You have successfully deleted your job application.');
    }
}