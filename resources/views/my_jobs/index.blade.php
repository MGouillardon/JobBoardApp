<x-layout>
    <x-breadcrumbs :links="['My Jobs' => '#']" class="mb-4" />
    <div class="mb-8 text-right">
        <x-link-button href="{{ route('my-jobs.create') }}" class="bg-white hover:bg-slate-50">
            Add new
        </x-link-button>
    </div>
    @forelse ($jobs as $job)
        <x-job-card :$job>
            <div class="text-xs text-slate-500">
                @forelse ($job->jobApplications as $application)
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <div class="font-bold">{{ $application->user->name }}</div>
                            <div>Applied {{ $application->created_at->diffForHumans() }}</div>
                            <div>Download CV</div>
                        </div>
                        <div>
                            ${{ number_format($application->expected_salary) }}
                        </div>
                    </div>
                @empty
                    No applications yet.
                @endforelse
                <div class="flex space-x-2">
                    <x-link-button href="{{ route('my-jobs.edit', $job) }}">
                        Edit
                    </x-link-button>
                    <form action="{{ route('my-jobs.destroy', $job) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <x-button class="bg-slate-100 hover:bg-slate-200">
                            Delete
                        </x-button>
                    </form>
                </div>
            </div>
        </x-job-card>
    @empty
        <div class="rounded-md border border-dashed border-slate-300 p-8">
            <div class="text-center font-medium mb-4">
                You have not posted any jobs yet.
            </div>
            <div class="text-center">
                Post your job <a class="text-indigo-500 hover:underline" href="{{ route('my-jobs.create') }}">here!</a>
            </div>
        </div>
    @endforelse
</x-layout>
