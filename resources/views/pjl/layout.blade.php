<!-- resources/views/layout.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
<!--    @vite('resources/css/pjl/dashboard.css')-->
<!--    <link href="{{ asset('css/history.css') }}" rel="stylesheet">-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
<!--    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>-->
</head>
<body class="bg-gray-100">
    @include('Navbar.NavPJL')
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
