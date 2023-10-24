<nav class="mb-8 flex justify-between text-lg font-medium">
    <ul class="flex space-x-2">
        <li>
            <a href="{{ route('jobs.index') }}">Home</a>
        </li>
    </ul>
    <ul class="flex space-x-2">
        @auth
            <li>
                <a href="{{ route('my-job-applications.index') }}">
                    {{ auth()->user()->name ?? 'Anynomus' }}: Applications
                </a>
            </li>
            <li>
                <a href="{{ route('my-jobs.index') }}">My Jobs</a>
            </li>
            <li>
                <form action="{{ route('auth.destroy') }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Logout</button>
                </form>
            </li>
        @else
            <li>
                <a href="{{ route('auth.create') }}">Sign in</a>
            </li>
        @endauth
    </ul>
</nav>
