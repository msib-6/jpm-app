<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
    @include('Navbar.NavMGR')
    <section id="content" class="py-8 px-4">
        <div id="main-content">
            @yield('content')
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script src="{{ asset('js/Navbar/script.js') }}"></script>
    @yield('scripts')
</body>
</html>
