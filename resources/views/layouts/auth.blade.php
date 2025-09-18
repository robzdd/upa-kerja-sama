<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title', 'Masuk - UPA Kerjasama POLINDRA')</title>
        @vite(['resources/css/app.css','resources/js/app.js'])
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    </head>
    <body class="min-h-screen bg-gray-50 font-sans text-gray-900">
        @yield('content')
    </body>
</html>


