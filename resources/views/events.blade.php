@extends('layouts.app')

@php
    // Meta Desc (clean_description) limit text upto 160 characters
    $metaDesc = 'Welcome to RSVP by Designcub3. RSVP by Designcub3 is a platform that allows you to create and manage your events.';
@endphp

@section('head', 'All Events')
@section('description', $metaDesc)
@section('image', asset('img/banner/webbanner.jpg'))

@section('page')
    <section class="min-h-screen py-10 lg:py-14 flex flex-row space-x-5 bg-gray-100">
        <div class="max-w-none lg:max-w-5xl w-full px-4 lg:px-0 mx-auto">

            <h1 class="text-2xl lg:text-4xl text-red-bni text-center font-bold mb-4 lg:mb-8">Incoming Event</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-y-2 lg:gap-y-0 gap-x-0 lg:gap-x-4">
                @foreach ($events as $event)

                <div
                    class="bg-white group hover:shadow hover:shadow-red-bni/30 cursor-pointer"
                    onclick="window.location='{{ route('event.show', $event->slug) }}';"
                    >
                    <img src="{{ $event->getFirstMediaUrl('banner') }}"
                        onerror="this.onerror=null;this.src='{{ asset('img/banner/webbanner.jpg') }}';"
                        alt="" class="w-full aspect-video object-center mb-2">
                    <div class="px-3 py-3">
                        <h3 class="text-red-bni font-bold text-base mb-2">{{ $event->name }}</h3>
                        <div class="flex flex-col gap-y-2 border-t border-red-bni pt-2">
                            <div class="flex flex-row items-center text-black space-x-2">
                                <div>
                                    <x-heroicon-o-calendar class="w-4 h-4" />
                                </div>
                                <div class="col-span-10 text-sm leading-none">
                                    {{ $event->start_date_full_formatted }}
                                </div>
                            </div>
                            @if ($event->is_online_event)
                                <div class="flex flex-row items-center text-black space-x-2">
                                    <div>
                                        <x-heroicon-o-globe-alt class="w-4 h-4" />
                                    </div>
                                    <div class="col-span-10 text-sm leading-none">
                                        {{ $event->detail->online_time_no_seconds }} (Online)
                                    </div>
                                </div>
                            @endif
                            @if ($event->is_offline_event)
                                <div class="flex flex-row items-center text-black space-x-2">
                                    <div>
                                        <x-typ-location class="w-4 h-4" />
                                    </div>
                                    <div class="col-span-10 text-sm leading-none">
                                        {{ $event->detail->offline_time_no_seconds }} (Offline)
                                    </div>
                                </div>
                            @endif

                            {{-- Register Button --}}
                            <a href="{{ route('event.show', $event->slug) }}"
                                class="bg-red-bni text-white text-sm font-semibold py-1 px-2 rounded-md text-center group hover:bg-red-bni/90 transition duration-500 ease-in-out">
                                <span>
                                    Register
                                </span>
                                <x-heroicon-o-arrow-right class="w-5 h-5 font-bold inline" />
                            </a>
                        </div>
                    </div>

                </div>
                @endforeach
                @for ($i = 0; $i < $skeletonsCount; $i++)
                    <div class="relative bg-white">
                        <div class="skeleton w-full aspect-video object-center mb-2"></div>
                        <div class="skeleton w-3/4 h-4 mb-2"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h3 class="text-red-bni text-base font-bold text-center">Empty Space</h3>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
@endsection
