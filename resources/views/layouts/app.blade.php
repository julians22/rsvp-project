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

    <footer class="bg-navy py-3 px-2 flex items-center justify-center fixed bottom-0 inset-x-0">
        <h4 class="text-sm lg:text-base text-white inline-flex">POWERED BY </h4>
        <a href="https://designcub3.com"
            rel="noopener noreferrer"
            target="_blank"
            class="inline-flex"
            >
            <img class="w-24 lg:w-32 ml-2" src="{{ asset('img/logo.svg') }}" alt="">
        </a>
    </footer>

    @livewireScripts

    @stack('after-scipts')
</body>

</html>
