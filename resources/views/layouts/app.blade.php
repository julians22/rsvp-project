<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @include('includes.analytics')

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=montserrat:300,400,500,600,700,800,900" rel="stylesheet" />

    @livewireStyles

    @vite('resources/css/app.css')

    <title>RSVP by Designcub3 | @yield('head', 'Home')</title>

    <meta name="title" content="RSVP by Designcub3 | @yield('head', 'Home')" />
    <meta name="description" content="@yield('description', 'Designcub3 RSVP')" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="RSVP by Designcub3 | @yield('head', 'Home')" />
    <meta property="og:description" content="@yield('description', 'Designcub3 RSVP')" />
    <meta property="og:image" content="@yield('image', asset('img/banner/webbanner.jpg'))" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:title" content="RSVP by Designcub3 | @yield('head', 'Home')" />
    <meta property="twitter:description" content="@yield('description', 'Designcub3 RSVP')" />
    <meta property="twitter:image" content="@yield('image', asset('img/banner/webbanner.jpg'))" />

</head>

<body class="relative bg-white antialiased">
    @yield('page')

    <footer class="sticky bottom-0 flex items-center justify-center bg-navy px-2 py-7">
        <h4 class="inline-flex text-sm text-white lg:text-base">POWERED BY </h4>
        <a class="inline-flex" href="https://designcub3.com" rel="noopener noreferrer" target="_blank">
            <img class="ml-2 w-24 lg:w-32" src="{{ asset('img/logo.svg') }}" alt="">
        </a>
    </footer>

    @livewireScripts

    @stack('after-scipts')
</body>

</html>
