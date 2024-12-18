@extends('layouts.app')

@php
    // Meta Desc (clean_description) limit text upto 160 characters
    $metaDesc =
        'Welcome to RSVP by Designcub3. RSVP by Designcub3 is a platform that allows you to create and manage your events.';
@endphp

@section('head', 'All Events')
@section('description', $metaDesc)
@section('image', asset('img/banner/webbanner.jpg'))


@section('page')
    <section class="flex min-h-screen flex-row space-x-5 bg-landing bg-bottom bg-no-repeat py-10 lg:py-14">
        <div class="mx-auto w-full max-w-none px-4 lg:max-w-5xl lg:px-0">

            <div class="mb-10 flex flex-col items-center justify-between gap-4 sm:mb-20 sm:flex-row">
                <div class="inline-flex grow-0 basis-1/4 flex-row items-center gap-4">
                    <div><img src="{{ asset('img/logo-bni.png') }}" alt="bni logo"></div>
                    <div><img src="{{ asset('img/logos.png') }}" alt="logos of orgs"></div>
                </div>
                <div class="grow-0 basis-1/4">
                    <img src="{{ asset('img/impactful.png') }}" alt="text impactful">
                </div>
            </div>

            <h1
                class="mb-4 w-fit text-2xl font-bold text-black after:mt-6 after:block after:h-1 after:w-1/4 after:border-t-0 after:bg-red-bni lg:mb-8 lg:text-4xl">
                UPCOMING EVENTS
            </h1>


            <div class="glide">
                <div class="glide__track mx-8 md:mx-16" data-glide-el="track">
                    <ul class="glide__slides">
                        @foreach ($events as $event)
                            <li
                                class="glide__slide grid cursor-pointer grid-cols-1 grid-rows-[auto_minmax(auto,1fr)_1fr_auto] gap-2 overflow-hidden rounded-b-xl bg-white shadow-xl hover:shadow hover:shadow-red-bni/30 lg:gap-4">
                                <img class="aspect-video w-full object-center"
                                    src="{{ $event->getFirstMediaUrl('banner') }}"
                                    onerror="this.onerror=null;this.src='{{ asset('img/banner/webbanner.jpg') }}';"
                                    alt="">

                                <div class="flex flex-row-reverse justify-end font-bold">
                                    <div class="mb-2 inline-block h-full w-full bg-gray-500/10 p-2 text-base text-black">
                                        <h2 class="line-clamp-3">
                                            {{ $event->name }}</h2>
                                    </div>
                                    <div
                                        class="grid flex-grow-0 basis-[40%] items-center justify-center bg-red-bni capitalize text-white">
                                        <h3 class="flex flex-col items-center justify-center text-2xl uppercase">
                                            <span>{{ date('d', strtotime($event->start_date_full_formatted)) }}</span>
                                            <span>{{ date('M', strtotime($event->start_date_full_formatted)) }}</span>
                                        </h3>
                                    </div>
                                </div>

                                <div class="px-3 py-3">

                                    <div class="flex flex-col gap-y-2 pb-6 pt-2">

                                        @if ($event->is_online_event)
                                            <div class="flex flex-row items-center space-x-2 text-black">
                                                <x-heroicon-o-globe-alt class="h-4 w-4 text-red-bni" />
                                                <div class="col-span-10 text-sm leading-none">
                                                    ONLINE - {{ $event->detail->online_time_no_seconds }}
                                                </div>
                                            </div>
                                        @endif

                                        @if ($event->is_offline_event)
                                            <div class="flex flex-row items-center space-x-2 text-black">
                                                <x-typ-location class="h-4 w-4 text-red-bni" />
                                                <div class="col-span-10 text-sm leading-none">
                                                    OFFLINE - {{ $event->detail->offline_time_no_seconds }}
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                {{-- Register Button --}}
                                <a class="group bg-red-bni py-4 text-center text-sm font-semibold text-white transition duration-500 ease-in-out hover:bg-red-bni/90"
                                    href="{{ route('event.show', $event->slug) }}">
                                    {{-- <span> --}}
                                    Register
                                    {{-- </span> --}}
                                    {{-- <x-heroicon-o-arrow-right class="inline h-5 w-5 font-bold" /> --}}
                                </a>

                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="glide__arrows" data-glide-el="controls">
                    <button class="glide__arrow glide__arrow--left -left-4 border-none shadow-none sm:left-0"
                        data-glide-dir="<">
                        <x-heroicon-o-arrow-left-circle class="size-8 text-black" />
                    </button>

                    <button class="glide__arrow glide__arrow--right -right-4 border-none shadow-none sm:right-0"
                        data-glide-dir=">">
                        <x-heroicon-o-arrow-right-circle class="size-8 text-black" />
                    </button>
                </div>
            </div>



            {{-- <div>
                @for ($i = 0; $i < $skeletonsCount; $i++)
                    <div class="relative bg-white">
                        <div class="skeleton mb-2 aspect-video w-full object-center"></div>
                        <div class="skeleton mb-2 h-4 w-3/4"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h3 class="text-center text-base font-bold text-red-bni">Empty Space</h3>
                        </div>
                    </div>
                @endfor
            </div> --}}
        </div>
    </section>
@endsection

@push('after-scipts')
    @vite('resources/js/landing.js')
@endpush
