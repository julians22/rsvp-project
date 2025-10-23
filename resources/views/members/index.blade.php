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
    <section class="my-8 flex min-h-dvh flex-row space-x-5 bg-landing bg-bottom bg-no-repeat">
        <div class="mx-auto w-full max-w-none px-4 lg:max-w-5xl lg:px-0">
            <x-container class="mb-4 flex justify-between justify-items-center gap-8 p-4 max-lg:flex-col lg:items-center">

                <x-event-list-title class="!m-auto !w-full !basis-3/4">
                    Member By Business Categories
                </x-event-list-title>

                <div class="flex basis-full flex-col gap-2">
                    <a @class([
                        'text-xs font-bold hover:underline',
                        'text-red-bni' => request()->fullUrlIs(route('members.index')),
                    ]) href="{{ route('members.index') }}">
                        All Categories
                    </a>

                    <ul class="grid grid-cols-2 gap-2">

                        @foreach ($categories as $category)
                            <li>
                                <a @class([
                                    'text-xs font-bold hover:underline',
                                    'text-red-bni' => request()->fullUrlIs(
                                        route('members.index', [
                                            'category' => $category->slug,
                                        ])),
                                ])
                                    href="{{ route('members.index', ['category' => $category->slug]) }}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </x-container>

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
