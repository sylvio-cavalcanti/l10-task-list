<!DOCTYPE html>
<html>

    <head>
        <title>Laravel 10 Task App</title>
        @yield('styles')
    </head>

    <body>
        <h1> @yield('title') </h1>
        <div>
            <!-- Checks if the success variable exists -->
            @if (session()->has('success')) 
                <div>{{ session('success') }}</div>
            @endif
            @yield('content')
        </div>
    </body>
    
</html>
