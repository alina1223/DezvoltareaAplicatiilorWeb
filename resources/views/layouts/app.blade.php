<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Academia IT')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="page-container">
        <!-- Header Component -->
        @include('partials.header')
        
        <!-- Navigation Menu Component -->
        @include('partials.menu')
        
        <!-- Main Content Area -->
        <main class="main-content">
            <div class="container">
                @yield('content')
            </div>
        </main>
        
        <!-- Footer Component -->
        @include('partials.footer')
    </div>
</body>
</html>
