<x-layout>
        <x-breadcrumbs class="mb-4" :links="['Jobs' => route('jobs.index'), $job->title => '#']" />
            <x-job-card :$job>
                <p class="mb-4 text-sm text-slate-500">
                    {!! nl2br(e($job->description)) !!}
                </p>
                @auth
                    @can('apply', $job)
                        <x-link-button :href="route('job.applications.create', $job)" class="mb-4">
                            Apply for this job
                        </x-link-button>
                    @else
                        <div class="text-center text-sm font-medium text-slate-500 border rounded-md p-2 ">
                            You have already applied for this job.
                        </div>
                    @endcan
                @else
                    <div class="text-center text-sm font-medium text-slate-500 border rounded-md p-2 ">
                        Please <a href="{{ route('login') }}" class="underline">log in</a> to apply for this job.
                    </div>
                @endauth
            </x-job-card>
            <x-card class="mb-4">
                <h2 class="mb-4 text-lg font-medium">
                    More {{ $job->employer->company_name }} Jobs
                </h2>
                <div class="flex flex-col">
                    @foreach ($job->employer->jobs as $otherJob)
                        @if ($otherJob->id !== $job->id)
                            <div class="mb-4 flex justify-between">
                                <div class="">
                                    <div class="text-slate-700">
                                        <a href="{{ route('jobs.show', $otherJob) }}">{{ $otherJob->title }}</a>
                                    </div>
                                    <div class="text-xs">
                                        {{ $otherJob->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                <div class="text-xs">
                                    ${{ number_format($otherJob->salary) }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </x-card>
</x-layout>
