@extends('layouts.app')

@section('page')

<header>

    <div class="relative aspect-[16/7] px-4 lg:px-0 w-full bg-fixed bg-center bg-no-repeat bg-cover" style="background-image: url({{ asset('img/banner/webbanner.jpg') }})">

        <div class="container mx-auto">
            <h2 class="absolute bottom-0 font-black text-white text-5xl lg:text-9xl">VISITOR <br> INFORMATION</h2>

        </div>
    </div>

    <div class="container mx-auto space-y-2 pb-14 px-4 lg:px-0">
        <h2 class="font-black text-black text-5xl lg:text-9xl">
            MEETING
        </h2>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 lg:gap-20">

            <div class="space-y-4">

                <h1 class="text-2xl lg:text-4xl font-semibold">Join us for this opportunity to connect, collaborate, and expand your network!</h1>

                <div class="">
                    <div class="p-4 lg:p-8 border border-black">
                        <h5 class="text-lg lg:text-xl font-semibold">DATE</h5>
                        <h5 class="text-xl lg:text-2xl font-semibold">5 NOVEMBER 2024</h5>
                    </div>
                    <div class="p-4 lg:p-8 border border-black relative">
                        <div class="flex justify-between items-end">
                            <div>
                                <h5 class="text-lg lg:text-xl font-semibold">ZOOM ONLINE</h5>
                                <h5 class="text-lg lg:text-xl font-bold">7.30 AM</h5>
                            </div>
                            <div class="text-center">
                                <span class="text-xl lg:text-2xl font-bold">
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
                        <div class="flex justify-between items-end">
                            <div>
                                <h5 class="text-lg lg:text-xl font-semibold">OFFLINE MEETING</h5>
                                <h5 class="text-lg lg:text-xl font-bold">11.00</h5>
                                <h5 class="text-lg lg:text-xl font-semibold">Rumah Koffe</h5>
                                <p class="text-lg font-semibold">
                                    Jl. Kuningan 123 <br>
                                    Jakarta Pusat
                                </p>
                            </div>
                            <div class="text-center">
                                <h5 class="text-xl lg:text-2xl font-bold">
                                    LUNCH <br>
                                    CHARGE
                                </h5>
                                <p class="text-xl lg:text-xl font-semibold">
                                    150k IDR/pax
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

            <div class="pr-0 lg:pr-56">
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

            <a class="bg-[#bd2232] text-white text-lg font-semibold px-3 py-2 inline-block hover:scale-105 transition-all ease-in-out" href="#">REGISTER NOW</a>
        </div>
    </div>


</header>

@endsection
