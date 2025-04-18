@extends('layouts.app')

@php
    // Meta Desc (clean_description) limit text upto 160 characters
    $metaDesc = Str::limit($event->detail->clean_description, 160);
@endphp

@section('head', $event->name ?? null)
@section('description', $metaDesc)
@section('image', $event->getFirstMediaUrl('banner'))


@section('page')
    <header>

        {{-- <div class="relative aspect-video w-full bg-cover bg-center bg-no-repeat lg:aspect-[16/7] lg:bg-fixed"
            style="background-image: url({{ $event->getFirstMediaUrl('banner') }})">

        </div> --}}

        {{-- @dd($event->is_offline_event) --}}

        <div class="relative aspect-[2.56/1] overflow-hidden">
            <img class="w-full" src="{{ $event->getFirstMediaUrl('banner') }}" alt="">
        </div>

        <div class="container mx-auto w-full space-y-4 pb-16 pt-6 lg:lg:w-[1200px] lg:space-y-6 lg:pt-14">

            <div class="container w-full px-4 lg:w-[1200px] lg:px-0">
                <span class="lg:leading-[100px]"><img class="max-w-20 lg:max-w-48" src="{{ asset('img/logo_bni.svg') }}"
                        alt="LOGO BNI"></span>
                <h2 class="text-4xl font-black lg:text-[80px] lg:leading-[100px]">NETWORKING <br>MEETING</h2>
            </div>
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-20">

                <div>
                    <div class="mb-4 px-4 text-lg font-semibold leading-loose text-gray-700 lg:px-0">
                        @if ($event->detail->override_description_1)
                            {!! $event->detail->description_1 !!}
                        @else
                            <p>
                                You are invited to join our <strong>BNI Altitude and BNI Magnitude
                                    <span>{{ ucwords($event->detail->event_type) }}</span></strong>,
                                where
                                many
                                business owners will come together to witness the 1st Ever Twin Chapter Launched in
                                Indonesia,
                                to
                                build connections, share business opportunities, and cultivate meaningful referrals or
                                friendships.
                                This event offers a unique platform to introduce your business to a wider audience, exchange
                                ideas,
                                and create valuable partnerships that can help you grow and succeed.
                            </p>
                        @endif

                    </div>

                    <video onloadeddata="this.play();this.muted=true;" poster="{{ asset('img/video_thumb.jpg') }}"
                        playsinline loop muted controls>
                        @if ($event->detail->override_video)
                            {{-- todo: sementara mp4, nanti ganti ambil mime type --}}
                            <source src="{{ $event->detail->getFirstMediaUrl('video') }}" type="video/mp4" />
                        @else
                            <source src="{{ asset('videos/BNI Video low.mp4') }}" type="video/mp4" />
                        @endif
                        Your browser does not support the video tag or the file format of this video.
                    </video>

                    <h4 class="mb-1 px-4 text-2xl font-bold leading-loose text-gray-800 lg:px-0">What is <img
                            class="inline max-w-14" src="{{ asset('img/logo_bni.svg') }}" alt="LOGO BNI">?</h4>

                    <div class="px-4 text-lg font-semibold leading-loose text-gray-700 lg:px-0">
                        @if ($event->detail->override_description_2)
                            {!! $event->detail->description_2 !!}
                        @else
                            <p>
                                BNI (Business Network International) is the
                                world’s largest business networking organization. It operates on a referral-based model,
                                where members meet regularly to build trust,
                                refer business to each other, and grow through
                                collaborative networking. Through BNI, members generate more business for one another,
                                based on the philosophy of "Givers Gain" —
                                helping others to grow their business in order
                                to receive help in return.
                            </p>
                        @endif
                    </div>
                </div>

                <div class="space-y-6 px-4 lg:px-0">

                    <img class="max-w-48 lg:max-w-[400px]" src="{{ asset('img/logo_bni.jpg') }}" alt="">

                    <h1 class="text-lg font-bold lg:text-2xl">Join us for this opportunity to connect, collaborate, and
                        expand your network!</h1>

                    <div class="">
                        <div class="border border-black px-4 py-4 lg:px-8 lg:py-6">
                            <h5 class="text-xl font-bold text-gray-800">DATE</h5>
                            <h5 class="text-xl font-medium lg:text-2xl">
                                {{ $event->start_date_full_formatted }}
                            </h5>
                        </div>

                        @if ($event->is_online_event)
                            <div class="relative border border-black px-4 pb-4 pt-4 lg:px-8 lg:pb-8 lg:pt-6">
                                <div class="flex items-end justify-between">
                                    <div>
                                        <h5 class="text-xl font-bold text-gray-800">ZOOM ONLINE</h5>
                                        <h5 class="text-xl font-bold lg:text-2xl">
                                            {{ $event->detail->online_time_no_seconds }}
                                        </h5>
                                    </div>
                                    <div class="text-center">
                                        <span class="inline-block bg-gray-200 px-4 py-2 text-xl font-bold leading-[25px]">
                                            FREE <br>
                                            ADMISSION
                                        </span>
                                    </div>
                                </div>

                                @if ($event->is_offline_event && $event->is_online_event)
                                    <div
                                        class="absolute bottom-0 translate-y-2 bg-black p-px text-sm font-bold leading-[17px] text-white lg:translate-y-4 lg:p-1">
                                        AND / OR
                                    </div>
                                @endif
                            </div>
                        @endif

                        @if ($event->is_offline_event)
                            <div class="border border-black px-4 pb-4 pt-4 lg:px-8 lg:pb-6 lg:pt-8">
                                <div class="flex flex-col space-y-4">
                                    <div>
                                        <h5 class="text-xl font-bold text-gray-800">OFFLINE MEETING</h5>
                                        <h5 class="text-xl font-bold lg:text-2xl">
                                            {{ $event->detail->offline_time_no_seconds }}
                                        </h5>
                                        {!! $event->detail->offline_address !!}
                                    </div>
                                    <div class="bg-gray-200 px-4 py-2 text-center">

                                        @if ($event->detail->override_offline_food_price_text)
                                            <h5 class="text-xl font-bold leading-[25px]">
                                                {{ $event->detail->offline_food_price_text }}
                                            </h5>
                                        @else
                                            <h5 class="text-xl font-bold leading-[25px]">
                                                PAY FOR YOUR LUNCH
                                            </h5>
                                            <p class="text-lg font-bold">
                                                {{ $event->detail->offline_food_price_currency }} IDR/pax
                                            </p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="border border-black px-4 py-4 lg:px-8 lg:py-6">
                            <h5 class="mb-2 text-lg font-bold">WHAT TO PREPARE</h5>
                            <ul class="list-inside list-disc">
                                @if ($this->event->slug != 'fun-bay-networking')
                                    <li class="text-lg font-medium">Wear Business Attire</li>
                                @endif
                                @if ($event->is_offline_event)
                                    <li class="text-lg font-medium">Bring Professional Namecards</li>
                                @endif
                                <li class="text-lg font-medium">Prepare Your Business Introduction</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-4 pt-6 text-center">
                <h2 class="text-center text-xl font-bold lg:text-2xl">WE LOOK FORWARD TO CONNECT WITH YOU!</h2>

                @if ($isDisabled)
                    <p class="text-lg font-semibold text-red-500">Registration has ended</p>
                @else
                    <a class="btn bg-red-bni" href="{{ route('event.register', ['slug' => $slug]) }}">REGISTER NOW</a>
                @endif

            </div>
        </div>


    </header>
@endsection
