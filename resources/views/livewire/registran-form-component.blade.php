
<div>
    <div class="flex justify-center ">
    @if (!$isSubmitted)

    <div class="max-w-full lg:max-w-screen-md w-full flex flex-col space-y-4 py-4 px-4 lg:px-2">
        <form wire:submit="save">
                {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

                {{-- <div class="px-4 py-2 bg-red-500 text-white text-center transition-all ease-in-out rounded sticky top-0" wire:offline>
                    <p class="text-bold">You Offline</p>
                </div> --}}

                <div>

                    <img src="{{ asset('img/logo_bni.jpg') }}" alt="" class="max-w-48 lg:max-w-[300px] mb-6">

                    <div>
                        <h1 class="text-3xl lg:text-[42px] font-medium leading-none">
                            VISITOR INFORMATION MEETING
                        </h1>
                        <h1 class="text-[40px] lg:text-[78px] font-bold mb-2 leading-none">
                            REGISTRATION
                        </h1>

                    </div>


                    <h2 class="text-3xl lg:text-[42px] font-bold uppercase">
                        {{ $this->event->start_date_full_formatted }}
                    </h2>
                </div>

                <div class="py-4">
                    <h4 class="text-xl lg:text-[24px]"><strong>NOTES:</strong></h4>
                    <p class="font-bold text-black text-3xl lg:text-[36px]">
                        REGISTRATION WILL BE CLOSED H-1 <br> AT 18.00 WIB
                    </p>
                </div>


                <div class="flex flex-col gap-y-4 lg:py-4">

                    {{-- NAMA LENGKAP --}}
                    <div
                        class="form-group"
                    >
                        <label for="name" class="form-label text-black">FULL NAME:</label>
                        <input type="text" id="name" wire:model.blur="name" class="w-full border border-black p-2" />
                        <div>
                            @error('name') <span class="error-form-message">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Klasifikasi Bisnis --}}
                    <div
                        class="form-group"
                    >
                        <label for="business" class="form-label text-black">BUSINESS CLASSIFICATION:</label>
                        <input type="text" id="business" wire:model='business' class="w-full border border-black p-2" />
                        <div>
                            @error('business') <span class="error-form-message">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Nama Perusahaan --}}
                    <div
                        class="form-group"
                    >
                        <label for="company" class="form-label text-black">COMPANY NAME:</label>
                        <input type="text" id="company" wire:model='company' class="w-full border border-black p-2" />
                        <div>
                            @error('company') <span class="error-form-message">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- NO HANDPHONE / WHATSAPP --}}
                    <div
                        class="form-group"
                    >
                        <label for="phone" class="form-label text-black">MOBILE PHONE / WHATSAPP:</label>
                        <input type="tel" id="phone" wire:model='phone' class="w-full border border-black p-2" />
                        <div>
                            @error('phone') <span class="error-form-message">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- EMAIL --}}
                    <div
                        class="form-group"
                    >
                        <label for="email" class="form-label text-black">EMAIL:</label>
                        <input type="email" wire:model='email' id="email" class="w-full border border-black p-2" />
                        <div>
                            @error('email') <span class="error-form-message">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- DIUNDANG OLEH: (Nama + Chapter) --}}
                    <div
                        class="form-group"
                    >
                        <label for="invited_by" class="form-label text-black">INVITED BY: (Name + Chapter):</label>
                        <input type="text" wire:model='invited_by' id="invited_by" class="w-full border border-black p-2" />
                        <div>
                            @error('invited_by') <span class="error-form-message">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label text-black">WILL BE ATTENDING TO: (May choose both)</label>

                        <div class="flex space-x-3">
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" value="online" wire:model.live="sessions" class="border-gray-300 border-2 text-black focus:border-gray-300 focus:ring-black w-6 h-6">
                                    <span class="ml-2 text-lg font-semibold">Online {{ $this->online_hour }} Pagi</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="checkbox" value="offline" wire:model.live="sessions" class="border-gray-300 border-2 text-black focus:border-gray-300 focus:ring-black w-6 h-6">
                                    <span class="ml-2 text-lg font-semibold">Offine {{ $this->offline_hour }} Siang</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            @error('sessions') <span class="error-form-message">{{ $message }}</span> @enderror
                        </div>

                    </div>

                </div>

                @if ($this->isOfflineSelected === true)


                    <div class="text-xl">
                        <h4 class="font-semibold">OFFLINE MEETING LOCATION</h4>

                        {!! $this->event->detail->offline_address !!}
                    </div>

                    <div class="flex flex-col gap-y-4">

                        {{-- PAKET MAKANAN + MINUMAN IDR 150.000 --}}
                        <div
                            class="flex flex-col gap-y-1"
                        >
                            <label for="food" class="text-lg text-black font-bold">LUNCH PACKAGE <strong class="font-extrabold">IDR {{ number_format($this->event->detail->offline_food_price, 0, ',', '.') }}</strong></label>
                            <select name="food" id="food" wire:model.live='food'>
                                <option value="">- PLEASE SELECT YOUR PREFERRED LUNCH MENU -</option>
                                @foreach ($this->offline_foods as $key => $item)
                                    <option value="{{$key}}">
                                        {{ $item['food'] }} - {{ $item['drink'] }}
                                    </option>
                                @endforeach
                            </select>

                            <div>
                                @error('food') <span class="error-form-message">{{ $message }}</span> @enderror
                            </div>

                        </div>

                        {{-- KETERANGAN --}}
                        <p class="font-semibold">Please transfer payment to <br><strong class="text-lg">Jessica Cynthia Dewi - BCA 8790178689</strong></p>

                        {{-- UPLOAD BUKTI PEMBAYARAN --}}

                        <div
                            class="form-group">
                            <label for="payment" class="form-label text-black">UPLOAD PROOF OF PAYMENT:</label>
                            <input type="file" accept="image/*" wire:model='payment' name="payment" id="payment" class="w-full border border-black p-2" />
                            <div>
                                @error('payment') <span class="error-form-message">{{ $message }}</span> @enderror
                            </div>
                        </div>

                    </div>

                @endif

                <div class="flex justify-center">
                    <button class="bg-red-bni btn w-full" type="submit">COMPLETE REGISTRATION</button>
                </div>

            </form>
        </div>

    @else

    <div class="max-w-full lg:max-w-screen-md w-full flex flex-col space-y-4 py-4 px-4 lg:px-2">
        {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

        <div>

            <img src="{{ asset('img/logo_bni.jpg') }}" alt="" class="max-w-48 lg:max-w-[300px] mb-6">

            <div class="mb-6">
                <h2 class="text-[40px] lg:text-[78px] font-bold mb-2 leading-none">
                    THANK YOU
                </h2>
                <h2 class="text-[40px] lg:text-[42px] font-medium leading-none">
                    FOR YOUR REGISTRATION
                </h2>
            </div>

            <h2 class="text-xl text-[24px] font-bold">
                SEE YOU ON {{ $this->event->start_date_full_formatted }}!
            </h2>
        </div>

        <div class="grid grid-cols-1">
            <div class="px-4 lg:px-6 py-4 space-y-4 border border-black">
                <h4 class="text-xl lg:text-2xl font-bold">
                    ONLINE ZOOM MEETING {{ $this->event->detail->online_time_no_seconds }}
                </h4>
                <div>
                    <h5 class="text-gray-800 text-lg lg:text-xl font-bold">LINK ZOOM</h5>
                    <h4 class="text-xl lg:text-2xl font-bold">
                        {{ $this->event->detail->online_link }}
                    </h4>
                </div>

                <div>
                    <h5 class="text-gray-800 text-xl font-bold">PASSWORD</h5>
                    <h4 class="text-xl lg:text-2xl font-bold">
                        {{ $this->event->detail->online_password }}
                    </h4>

                    <div class="mt-6">
                        <h5 class="text-lg font-bold mb-2">WHAT TO PREPARE</h5>
                        <ul class="list-inside list-disc">
                            <li class="text-lg font-medium">Wear Business Attire</li>
                            <li class="text-lg font-medium">Use Quality Internet Connection, Headset & Webcam</li>
                            <li class="text-lg font-medium">Prepare Your Business Introduction</li>
                            <li class="text-lg font-medium">Please be On-Cam all the time</li>
                            <li class="text-lg font-medium">Use provided Zoom Meeting Background</li>
                        </ul>
                    </div>
                </div>

                <a href="//designcub3.com" class="btn bg-red-bni">
                    DOWNLOAD ZOOM MEET BACKGROUND
                </a>

            </div>

            @if ($this->isOfflineSelected)
                <div class="px-4 lg:px-6 py-4 space-y-4 border-black border">
                    <h4 class="text-xl lg:text-2xl font-bold">
                        OFFLINE MEETING {{ $this->event->detail->offline_time_no_seconds }}
                    </h4>

                    <div>
                        <h5 class="text-gray-800 text-lg font-bold">LOCATION:</h5>
                        {!!
                            $this->event->detail->offline_address
                        !!}
                    </div>

                    <a href="{{ $this->event->detail->offline_location }}" class="btn bg-red-bni">
                        GOOGLE MAP
                    </a>

                    <div>
                        <h5 class="text-gray-800 text-lg font-bold">PAKET MAKANAN + MINUMAN</h5>
                        <h4 class="text-xl lg:text-2xl font-bold">
                            {{ $this->event->detail->online_link }}
                        </h4>

                        <div class="mt-6">
                            <h5 class="text-lg font-bold mb-2">WHAT TO PREPARE</h5>
                            <ul class="list-inside list-disc">
                                <li class="text-lg font-medium">Wear Business Attire</li>
                                <li class="text-lg font-medium">Bring lots of Namecards</li>
                                <li class="text-lg font-medium">Prepare Your Business Introduction</li>
                                <li class="text-lg font-medium">Please be on-time</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    @endif

</div>


</div>
