<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:300,400,500,600,700,800,900" rel="stylesheet" />
    @livewireStyles
    @vite('resources/css/app.css')

    <title>
        @yield('head', 'Designcub3 RSVP')
    </title>
</head>

<body>
    @yield('page')

    <footer class="fixed inset-x-0 bottom-0 flex items-center justify-center bg-navy px-2 py-3">
        <h4 class="inline-flex text-sm text-white lg:text-base">POWERED BY </h4>
        <a class="inline-flex" href="https://designcub3.com" rel="noopener noreferrer" target="_blank">
            <img class="ml-2 w-24 lg:w-32" src="{{ asset('img/logo.svg') }}" alt="">
        </a>
    </footer>

    @livewireScripts

    @stack('after-scipts')
</body>

</html>
