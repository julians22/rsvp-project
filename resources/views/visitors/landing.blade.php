@extends('layouts.app')

@section('page')

<header>

    <div class="relative aspect-[16/7] w-full bg-fixed bg-center bg-no-repeat bg-cover" style="background-image: url({{ asset('img/banner/webbanner.jpg') }})">

        <div class="container w-full lg:w-3/5 mx-auto px-4 lg:px-0 absolute bottom-0 inset-x-0">
            <h2 class="font-black text-white text-4xl lg:text-8xl">VISITOR <br> INFORMATION</h2>

        </div>
    </div>

    <div class="container w-full lg:w-3/5 mx-auto space-y-4 lg:space-y-6 pb-14 px-4 lg:px-0">
        <h2 class="font-black text-black text-4xl lg:text-8xl">
            MEETING
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20">

            <div class="space-y-6">

                <img src="{{ asset('img/logo_bni.jpg') }}" alt="" class="max-w-48 lg:max-w-[400px]">

                <h1 class="text-2xl lg:text-3xl font-semibold">Join us for this opportunity to connect, collaborate, and expand your network!</h1>

                <div class="">
                    <div class="p-4 lg:p-8 border border-black">
                        <h5 class="text-lg lg:text-xl font-semibold">DATE</h5>
                        <h5 class="text-xl lg:text-2xl font-semibold">
                            {{ $event->start_date_formatted }}
                        </h5>
                    </div>
                    <div class="p-4 lg:p-8 border border-black relative">
                        <div class="flex justify-between items-end">
                            <div>
                                <h5 class="text-lg lg:text-xl font-bold">ZOOM ONLINE</h5>
                                <h5 class="text-lg lg:text-xl font-bold">
                                    {{ $event->detail->online_time_no_seconds }}
                                </h5>
                            </div>
                            <div class="text-center">
                                <span class="text-xl lg:text-2xl font-bold bg-gray-200 px-4 py-2 block">
                                    FREE <br>
                                    ADMISSION
                                </span>
                            </div>
                        </div>

                        <div class="bottom-0 translate-y-4 absolute text-base lg:text-lg font-bold p-px lg:p-1 bg-black text-white">
                            AND/OR
                        </div>
                    </div>
                    <div class="p-4 lg:p-8 border border-black">
                        <div class="flex flex-col space-y-4">
                            <div>
                                <h5 class="text-lg lg:text-xl font-bold">OFFLINE MEETING</h5>
                                <h5 class="text-lg lg:text-xl font-bold"> {{ $event->detail->offline_time_no_seconds }} </h5>
                                {!!
                                    $event->detail->offline_address
                                !!}
                            </div>
                            <div class="text-center bg-gray-200 px-4 py-2">
                                <h5 class="text-xl lg:text-2xl font-bold">
                                    LUNCH CHARGE
                                </h5>
                                <p class="text-xl lg:text-xl font-semibold">
                                    {{ $event->detail->offline_food_price_currency }}/pax
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 lg:p-8 border border-black">
                        <h5 class="text-xl lg:text-3xl font-bold mb-4">WHAT TO PREPARE</h5>
                        <ul class="list-inside list-disc">
                            <li class="text-xl lg:text-2xl font-semibold">Wear Business Attire</li>
                            <li class="text-xl lg:text-2xl font-semibold">Bring Professional Namecards</li>
                            <li class="text-xl lg:text-2xl font-semibold">Prepare Your Business Introduction</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="pr-0 lg:pr-20">
                <p class="text-lg text-gray-700 font-semibold mb-4 leading-loose">You are invited to join our BNI VISITOR
                    INFORMATION MEETING, where most business
                    owners will come together to build
                    connections, share business opportunities, and
                    cultivate meaningful referrals or friendships.
                    This event offers a unique platform to introduce
                    your business to a wider audience, exchange
                    ideas, and create valuable partnerships that can
                    help you grow and succeed.</p>

                <h4 class="text-gray-800 text-2xl font-semibold mb-2 leading-loose">What is BNI?</h4>
                <p class="text-lg text-gray-700 font-semibold leading-loose">
                    BNI (Business Network International) is the
                    world’s largest business networking organization. It operates on a referral-based model,
                    where members meet regularly to build trust,
                    refer business to each other, and grow through
                    collaborative networking. Through BNI, members generate more business for one another,
                    based on the philosophy of "Givers Gain" —
                    helping others to grow their business in order
                    to receive help in return.
                </p>
            </div>
        </div>

        <div class="space-y-4 text-center pt-6">
            <h2 class="text-xl lg:text-2xl font-bold text-center">WE LOOK FORWARD TO CONNECT WITH YOU!</h2>

            <a class="bg-[#bd2232] text-white text-lg font-semibold px-3 py-2 inline-block hover:scale-105 transition-all ease-in-out" href="{{ route('event.register', ['slug' => $slug]) }}">REGISTER NOW</a>
        </div>
    </div>


</header>

@endsection
