<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- In your master.blade.php header -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    {{-- this is for the ajax database tables --}}


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
