@extends('layouts.app')

@php
    // Meta Desc (clean_description) limit text upto 160 characters
    $metaDesc =
        'Official Website BNI Magnitude. We are a thriving and dynamic community of professionals and business owners, united by a shared commitment to excellence, collaboration, and trust. Through the power of strategic connections and mutual support, we work together to deliver impactful solutions and help each other grow.';
@endphp

@section('head', 'All Events')
@section('description', $metaDesc)
@section('image', asset('img/banner/webbanner.jpg'))

@section('page')

    <div class="relative h-auto w-full">
        <video class="h-auto w-full object-cover" src="{{ asset('videos/header-3.mp4') }}" autoplay loop muted></video>

        <img class="mx-auto -mt-[clamp(2rem,20vw,8rem)] w-full max-w-[min(100%,640px)]"
            src="{{ asset('img/LogoChapter.png') }}" alt="Logo Chapter">
    </div>

    <section class="flex min-h-dvh flex-row space-x-5 overflow-clip bg-landing bg-bottom bg-no-repeat">
        <div class="mx-auto w-full max-w-none px-4 lg:max-w-5xl lg:px-0">

            <x-event-list-title>
                UPCOMING EVENTS
            </x-event-list-title>

            {{-- desktop slider --}}
            <x-event-list.desktop :events="$events" />

            {{-- mobile grid --}}
            <x-event-list.mobile :events="$events" />

            <x-container class="mb-12 mt-10">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-[0.5fr_1fr]">
                    <div class="flex flex-col flex-wrap justify-between gap-4">
                        <div class="w-full max-w-32">
                            <img src="{{ asset('img/logo_bni.svg') }}" alt="">
                        </div>
                        <p class="text-[min(10vw,1.5rem)] font-bold text-red-bni">
                            The World's Largest
                            Referral Networking
                            Organization
                        </p>
                    </div>
                    <div class="flex flex-col gap-4 text-[min(10vw,0.85rem)]">
                        <p>
                            Become a part of a local network with global reach. BNI Members around the
                            world meet in-person or online to pass billions of dollars worth of referrals to
                            each other every year.
                        </p>
                        <p>
                            Established in 1985, BNI operates with a mission to help professionals build
                            meaningful relationships, generate business opportunities, and achieve success
                            through structured, positive, and supportive networking.
                        </p>
                        <p>
                            With a presence in over 70 countries and a network of more than 300,000
                            members, BNI focuses on the philosophy of Givers Gain®, fostering a culture
                            where helping others succeed leads to mutual growth.
                        </p>
                    </div>
                </div>
            </x-container>

            <div
                class="my-8 grid grid-flow-row grid-cols-2 uppercase max-lg:-mx-4 md:grid-cols-4 lg:-mx-[calc((100vw-64rem)/2)]">

                @foreach ([
            'grow_your_business.png' => 'Grow your business',
            'building_relationship.png' => 'Building relationship',
            'sharpen_your_skills.png' => 'Sharpen your skills',
            'referral_networking.png' => 'Referral networking',
        ] as $key => $text)
                    <div class="group relative grid aspect-square grid-cols-1 grid-rows-1">
                        <div
                            class="overflow-clip after:opacity-0 after:transition-opacity after:duration-500 group-hover:after:absolute group-hover:after:inset-0 group-hover:after:bg-black/25 after:group-hover:opacity-100 group-hover:after:content-['']">
                            <img class="size-full object-cover transition-transform duration-500 group-hover:scale-125"
                                src="{{ asset('img/' . $key) }}" alt="{{ $text }} illustration">
                        </div>
                        <p
                            class="absolute flex size-full items-center justify-center whitespace-pre-line text-center text-xl font-semibold text-white drop-shadow-md transition-all duration-[350ms] group-hover:text-2xl">
                            <span class="sr-only">{{ $text }}</span>
                            {!! str_replace(' ', '<br />', $text) !!}
                        </p>
                    </div>
                @endforeach
            </div>

            {{-- stats new --}}
            <x-container class="mt-10">
                <div
                    class="flex flex-col gap-12 rounded-lg bg-red-bni bg-stats bg-cover bg-bottom bg-no-repeat px-8 py-4 text-white bg-blend-multiply shadow-[8px_6px_7px_-5px_rgba(0,_0,_0,_0.5)] max-md:my-10 md:mb-10 md:px-16 md:py-10">
                    <div class="grid gap-8 lg:grid-cols-[0.5fr,1fr]">
                        <p class="flex text-[min(10vw,6rem)] font-black uppercase leading-[5rem] text-bni-gold lg:flex-col">
                            <span>mag</span>
                            <span>ni</span>
                            <span>tu</span>
                            <span>de</span>
                        </p>

                        <div class="flex flex-col gap-4">
                            <div class="flex items-center justify-between gap-4 brightness-0 invert">
                                <div class="basis-24"><img src="{{ asset('img/logo-bni.png') }}" alt=""></div>
                                <div class="basis-48"><img src="{{ asset('img/impactful.png') }}" alt=""></div>
                            </div>

                            <p>
                                We are a thriving and dynamic community of professionals and
                                business owners, united by a shared commitment to excellence,
                                collaboration, and trust. Through the power of strategic connections
                                and mutual support, we work together to deliver impactful solutions
                                and help each other grow.
                            </p>

                            <p>
                                At BNI Magnitude, networking isn't just about exchanging contacts —
                                it's about building meaningful relationships, sharing opportunities,
                                and creating real value for everyone involved. And the best part?
                                Networking with BNI Magnitude is not only impactful — it's also FUN.
                                We grow together, celebrate success together, and enjoy the journey
                                of business and personal growth every step of the way.
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex flex-wrap items-center justify-center gap-8 px-4 text-center text-5xl font-bold uppercase md:justify-between md:gap-4 md:px-8 [&>div>*+*]:text-lg">
                        <div>
                            <p>{{ $memberCount }}</p>
                            <p>members</p>
                        </div>
                        <div>
                            <p>+{{ $visitorCount }}</p>
                            <p>total registrants</p>
                        </div>
                        <div>
                            <p>{{ $eventsCount }}</p>
                            <p>events held</p>
                        </div>
                    </div>
                </div>
            </x-container>

            <!-- Place <div> tag where you want the feed to appear -->
            <div class="mx-8 md:mx-16">
                <div id="curator-feed-default-feed-layout"><a class="crt-logo crt-tag" href="https://curator.io"
                        target="_blank">Powered by Curator.io</a></div>
            </div>

            <x-event-list-title>
                Past events
            </x-event-list-title>

            {{-- past events --}}
            {{-- desktop slider --}}
            <x-past-event-list.slider :events="$past_events" />

        </div>
    </section>
@endsection

@push('after-scipts')
    @vite('resources/js/landing.js')

    <!-- The Javascript can be moved to the end of the html page before the </body> tag -->
    <script type="text/javascript">
        /* curator-feed-default-feed-layout */
        (function() {
            var i, e, d = document,
                s = "script";
            i = d.createElement("script");
            i.async = 1;
            i.charset = "UTF-8";
            i.src = "https://cdn.curator.io/published/11955bd7-94c0-4ee3-81fc-ab2366ac7161.js";
            e = d.getElementsByTagName(s)[0];
            e.parentNode.insertBefore(i, e);
        })();
    </script>
@endpush
