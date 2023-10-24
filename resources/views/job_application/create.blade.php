<x-layout>
    <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => route('jobs.show', $job), 'Apply' => '#']" />
    <x-job-card :$job />
    <x-card>
        <h2 class="mb-4 text-lg font-medium">
            Apply for this job
        </h2>
        <form action="{{ route('job.applications.store', $job) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <x-label for="expected_salary" :required="true">Expected Salary</x-label>
                <x-text-input name="expected_salary" type="number" id="expected_salary" />
            </div>
            <div class="mb-4">
                <x-label for="resume" :required="true">Upload CV</x-label>
                <x-text-input name="cv" id="cv" type="file" />
            </div>
            <x-button class="w-full">Apply</x-button>
        </form>
    </x-card>
</x-layout>
