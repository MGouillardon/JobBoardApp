<nav {{ $attributes }}>
    <ul class="flex space-x-2 text-slate-700">
        <li>
            <a href="/">Home</a>
        </li>
        @foreach ($links as $label => $link)
            <li>
                →
            </li>
            <li>
                <a class="hover:text-slate-900" href="{{ $link }}">{{ $label }}</a>
            </li>
        @endforeach
    </ul>
</nav>
