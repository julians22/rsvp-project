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
    <div class="sticky top-0 z-20 bg-red-bni">

        @php
            $navItems = [
                [
                    'name' => 'Events',
                    'href' => route('event.index'),
                    'slug' => 'events',
                    'subItems' => [],
                ],
                [
                    'name' => 'Members',
                    // 'href' => route('members.index'),
                    'href' => '#',
                    'slug' => 'members',
                    'subItems' => [
                        ...\App\Models\MemberCategory::all()
                            ->append(['href'])
                            ->map(function ($category) {
                                $category->href = route('members.index', ['category' => $category->slug]);
                                return $category;
                            }),
                    ],
                ],
                [
                    'name' => 'Contact',
                    'href' => route('contact.index'),
                    'slug' => 'contact',
                    'subItems' => [],
                ],
            ];
        @endphp
        <div class="mx-auto w-full max-w-none px-4 lg:max-w-5xl lg:px-0">
            <x-container>
                <nav class="relative z-10 w-auto" x-data="{
                    width: 0,
                    height: 0,
                    windowWidth: 0,
                    windowHeight: 0,
                    navigationMenuOpen: false,
                    navigationMenu: '',
                    navigationMenuCloseDelay: 200,
                    navigationMenuCloseTimeout: null,
                    isBreakpoint(width) {
                        const breakpoints = {
                            'sm': 640,
                            'md': 768,
                            'lg': 1024,
                            'xl': 1280,
                            '2xl': 1536,
                        };
                
                        const isNumber = typeof width === 'number'
                
                        const matchingBreakpoint = isNumber ?
                            width :
                            Object.keys(breakpoints).find(key => key === width)
                
                        if (!matchingBreakpoint) {
                            return false;
                        }
                
                        console.log(this.windowWidth)
                
                        return isNumber ? this.windowWidth >= matchingBreakpoint : this.windowWidth >= breakpoints[matchingBreakpoint];
                    },
                    navigationMenuLeave() {
                        let that = this;
                        this.navigationMenuCloseTimeout = setTimeout(() => {
                            that.navigationMenuClose();
                        }, this.navigationMenuCloseDelay);
                    },
                    navigationMenuReposition(navElement) {
                        this.navigationMenuClearCloseTimeout();
                        // this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px';
                        // this.$refs.navigationDropdown.style.left = 0 + 'px';
                        // this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth / 2) + 'px';
                    },
                    navigationMenuClearCloseTimeout() {
                        clearTimeout(this.navigationMenuCloseTimeout);
                    },
                    navigationMenuClose() {
                        this.navigationMenuOpen = false;
                        this.navigationMenu = '';
                    }
                }" x-resize="width = $width; height = $height"
                    x-resize.document="windowHeight = $height; windowWidth = $width;" x-init="width = $el.offsetWidth;
                    height = $el.offsetHeight;
                    windowHeight = window.innerHeight;
                    windowWidth = window.innerWidth;">
                    <div
                        class="relative mx-auto flex w-full max-w-none items-center justify-between px-8 max-lg:py-4 lg:max-w-5xl xl:px-0">
                        <div class="w-full max-w-24 brightness-0 invert">
                            <img src="{{ asset('img/logo-bni.png') }}" alt="">
                        </div>
                        <ul
                            class="flex h-full flex-wrap items-center justify-end gap-[clamp(0.2rem,4vw,2.3rem)] font-semibold uppercase text-white max-lg:hidden max-sm:items-end md:mx-16">
                            @foreach ($navItems as $item)
                                <li class="py-[clamp(0.5rem,4vw,2.3rem)] lg:py-8"
                                    @if (!empty($item['subItems'])) @mouseover="() => {
                                                if (isBreakpoint('lg')) {
                                                    navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='{{ $item['slug'] }}'
                                                }
                                            }"
                                        @mouseleave="navigationMenuLeave()" @endif>
                                    @if (!empty($item['href']) || $item['slug'] === 'members')
                                        <a href="{{ $item['href'] }}">
                                            <span>{{ $item['name'] }}</span>
                                        </a>
                                    @else
                                        <p>{{ $item['name'] }}</p>
                                    @endif
                                </li>
                            @endforeach
                        </ul>

                        <x-lucide-menu class="basis-10 cursor-pointer text-white lg:hidden"
                            @click="navigationMenuOpen = !navigationMenuOpen" />
                    </div>

                    {{-- /* ********************** SUBITEMS ********************** */ --}}
                    <div class="fixed left-0 z-10 w-dvw duration-200 ease-out"
                        :style="{ 'margin-bottom': -height + 'px' }" x-ref="navigationDropdown"
                        x-show="navigationMenuOpen" x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-100"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
                        @mouseover="navigationMenuClearCloseTimeout()" @mouseleave="navigationMenuLeave()" x-cloak>
                        <div
                            class="flex h-auto w-auto justify-center overflow-hidden border border-neutral-200/70 bg-white shadow-sm">
                            @foreach ($navItems as $item)
                                @if (!empty($item['subItems']))
                                    <div class="relative mx-auto flex w-full max-w-none items-start justify-between gap-x-3 px-2 py-4 max-lg:flex-col lg:max-w-5xl"
                                        x-show="navigationMenu == '{{ $item['slug'] }}'">
                                        <div class="flex-shrink-0 max-lg:pb-4 lg:basis-56">
                                            <x-event-list-title class="!m-auto !w-full !basis-3/4">
                                                Member By Business Categories
                                            </x-event-list-title>
                                        </div>
                                        <div class="grid gap-6 lg:grid-cols-2">
                                            @foreach ($item['subItems'] as $subitem)
                                                <a class="block rounded px-3.5 py-3 text-sm hover:bg-neutral-100"
                                                    href="{{ $subitem->href ?? '#' }}" @click="navigationMenuClose()">
                                                    <span
                                                        class="mb-1 block font-medium text-black">{{ $subitem->name }}</span>
                                                    @if (!empty($subitem->description))
                                                        <span
                                                            class="block font-light leading-5 opacity-50">{{ $subitem->description }}</span>
                                                    @endif
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </nav>
            </x-container>

        </div>

    </div>

    @yield('page')

    <footer class="sticky bottom-0 z-50 flex items-center justify-center bg-navy px-2 py-4">
        <h4 class="inline-flex text-sm text-white lg:text-base">POWERED BY </h4>
        <a class="inline-flex" href="https://designcub3.com" rel="noopener noreferrer" target="_blank">
            <img class="ml-2 w-24 lg:w-32" src="{{ asset('img/footer-logo.gif') }}" alt="">
        </a>
    </footer>

    @livewireScripts

    @stack('after-scipts')
</body>

</html>
