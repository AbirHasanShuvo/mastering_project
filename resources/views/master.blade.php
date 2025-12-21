<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @stack('styles')
</head>

<body>

    {{-- Header --}}
    @include('layouts.header')

    <div style="display: flex;">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        {{-- Main Content --}}
        <main style="flex: 1; padding: 20px;">
            @yield('content')
        </main>

    </div>

    {{-- Footer --}}
    @include('layouts.footer')

    @stack('scripts')
</body>

</html>
