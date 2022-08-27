<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ env('APP_NAME') }}</title>
        @vite('resources/css/app.css')
    </head>
    <body>
        <section class="h-screen">
            @yield('content')
        </section>
    </body>
</html>
