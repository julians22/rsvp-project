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
    <section class="flex min-h-dvh flex-row space-x-5 bg-landing bg-bottom bg-no-repeat pb-14">
        <div class="mx-auto w-full max-w-none px-4 lg:max-w-5xl lg:px-0">
            <x-event-list-title>
                Marketing & event
            </x-event-list-title>

            <x-container>
                <div class="grid grid-cols-1 gap-4 p-4 sm:grid-cols-2 md:grid-cols-3">
                    @foreach ($members as $member)
                        <x-member-card :member="$member" />
                    @endforeach
                </div>
            </x-container>

            <x-container>
                {{ $members->links() }}
            </x-container>
        </div>
    </section>
@endsection
