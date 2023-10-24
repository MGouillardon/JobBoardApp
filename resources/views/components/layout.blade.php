<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Job Board App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="mx-auto mt-10 max-w-xl lg:max-w-2xl bg-gradient-to-r from-cyan-200 to-blue-200 text-slate-700">
    <x-navbar />
    @if (session()->has('success'))
        <div class="my-8 bg-green-200 text-green-800 p-4 rounded" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="my-8 bg-red-200 text-red-800 p-4 rounded" role="alert">
            {{ session('error') }}
        </div>
    @endif
    {{ $slot }}
</body>

</html>
