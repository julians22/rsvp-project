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
    <section class="flex min-h-dvh flex-row space-x-5 bg-landing bg-bottom bg-no-repeat py-14">
        <div class="mx-auto w-full max-w-none px-4 lg:max-w-5xl lg:px-0">

            <div class="mx-8 mb-10 flex items-center justify-between gap-4 max-sm:items-end sm:mb-20 md:mx-16">
                <div class="inline-flex shrink-0 grow-0 basis-2/5 flex-row items-center gap-4 sm:basis-40">
                    <div><img src="{{ asset('img/logo-bni.png') }}" alt="bni logo"></div>
                </div>
                <div class="inline-flex w-full items-center max-sm:basis-3/5 max-sm:flex-col md:justify-between">
                    <div class="max-w-48 sm:max-w-72"><img src="{{ asset('img/LogoChapter.png') }}" alt="Logo Chapter"></div>
                    <div class="max-w-48 sm:max-w-72"><img src="{{ asset('img/impactful.png') }}" alt="text impactful">
                    </div>
                </div>
            </div>

            <h1
                class="mb-12 w-full text-3xl font-bold text-black after:mt-6 after:block after:h-1 after:w-1/4 after:border-t-0 after:bg-red-bni max-md:text-center max-md:after:mx-auto md:mx-16 md:after:w-1/6 lg:text-4xl">
                UPCOMING EVENTS
            </h1>

            {{-- desktop slider --}}
            <x-event-list.desktop :events="$events" />

            {{-- mobile grid --}}
            <x-event-list.mobile :events="$events" />



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
