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

            <x-event-list-title>
                UPCOMING EVENTS
            </x-event-list-title>

            {{-- desktop slider --}}
            <x-event-list.desktop :events="$events" />

            {{-- mobile grid --}}
            <x-event-list.mobile :events="$events" />

            <div
                class="flex flex-wrap items-center justify-center gap-8 rounded-lg bg-red-bni bg-stats bg-cover bg-bottom bg-no-repeat px-8 py-4 text-center text-5xl font-bold text-white bg-blend-multiply shadow-[8px_6px_7px_-5px_rgba(0,_0,_0,_0.5)] max-md:my-10 md:mx-16 md:mb-10 md:justify-between md:gap-4 md:px-20 md:py-10 [&>div>*+*]:text-lg">
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
                    <p>events helds</p>
                </div>
            </div>

            <x-event-list-title>
                Past events
            </x-event-list-title>

            {{-- past events --}}
            {{-- desktop slider --}}
            <x-past-event-list.desktop :events="$past_events" />

            {{-- mobile grid --}}
            <x-past-event-list.mobile :events="$past_events" />



        </div>
    </section>
@endsection

@push('after-scipts')
    @vite('resources/js/landing.js')
@endpush
