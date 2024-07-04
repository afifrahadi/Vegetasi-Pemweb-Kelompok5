<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $page_title }} &mdash; {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="shortcut icon" href="{{ asset('logo-icon.svg') }}" type="image/svg+xml">

    <style>
        body {
            background: url(@yield('background_url', '/assets/topographic-5.svg')),
            #fafafa;
            background-blend-mode: color-burn;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: center;
        }
    </style>

    @stack('page-css')
</head>

<body>
    @include('admin.layouts.partials.navbar')

    <main>
        <div class="container py-5">
            <h2 class="fs-1 fw-bold mb-5">{{ $page_title }}</h2>

            @section('alert')
                @if (session('message'))
                    <div class="alert alert-secondary alert-dismissible fade show mb-3" role="alert">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            @show

            @yield('content')
        </div>
    </main>

    @yield('modal')
    @stack('page-js')
</body>

</html>
