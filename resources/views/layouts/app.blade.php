<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>

<body>
    @yield('page')

    <footer class="bg-navy py-3 px-2 flex items-center justify-center fixed bottom-0 inset-x-0">
        <h4 class="text-base text-white">POWERED BY <strong><a href="//designcub3.com"
            rel="noopener noreferrer"
            target="_blank"
            >DESIGNCUB3.COM</a></strong></h4>
    </footer>

</body>

</html>
