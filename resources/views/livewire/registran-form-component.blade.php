<div>
    <div class="flex justify-center">
        @if (!$isSubmitted)

            <div class="flex w-full max-w-full flex-col space-y-4 px-4 py-4 lg:max-w-screen-md lg:px-2">
                <form wire:submit="save">
                    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

                    <div class="sticky top-0 rounded bg-red-500 px-4 py-2 text-center text-white transition-all ease-in-out"
                        wire:offline>
                        <p class="text-bold">
                            You are currently offline. Please check your internet connection.
                        </p>
                    </div>

                    <div>

                        <img class="mb-6 max-w-48 lg:max-w-[300px]" src="{{ asset('img/logo_bni.jpg') }}" alt="">

                        <div>
                            <div>
                                <p class="flex items-center space-x-1 text-2xl font-medium leading-none lg:text-[42px]">
                                    <img class="w-10 lg:w-16" src="{{ asset('img/logo_bni.svg') }}" alt="">
                                    <span>
                                        @if ($this->event->slug == 'bni-networking-meeting-20-may-2025')
                                            ONSITE WEEKLY MEETING
                                        @else
                                            NETWORKING MEETING
                                        @endif
                                    </span>
                                </p>
                                <h1 class="mb-2 text-[40px] font-bold leading-none lg:text-[78px]">REGISTRATION</h1>
                                <span class="rounded-lg bg-black p-1 text-xl font-bold uppercase text-white">
                                    {{ $this->event->start_date_full_formatted }}
                                </span>
                            </div>

                        </div>


                    </div>

                    <div class="my-2 rounded bg-gray-300 px-4 py-4">
                        <h4 class="text-base"><strong>NOTES:</strong></h4>
                        <p class="text-base font-bold text-black">
                            @if ($this->event->slug == 'bni-networking-meeting-20-may-2025')
                                <span class="font-bold text-red-bni">REGISTRATION WILL BE CLOSED H-4, 16 MAY 2025</span>
                            @else
                                REGISTRATION WILL BE CLOSED H-1 AT 15.00 WIB
                            @endif
                        </p>
                    </div>


                    <div class="flex flex-col gap-y-4 lg:py-4">

                        {{-- REGISTER AS --}}
                        <div class="form-group">
                            <label class="form-label text-black" for="type">REGISTER AS:</label>

                            <select id="type" name="type" wire:model.change="type" @class(['w-full border border-black p-2'])>
                                <option disabled selected value=''> -- select an option -- </option>

                                @foreach ($this->visitor_type as $type)
                                    <option value="{{ $type->value }}" wire:key="type-{{ $type->value }}"
                                        @class([])>
                                        {{ $type->getLabel() }}
                                    </option>
                                @endforeach
                            </select>

                            <div>
                                @error('type')
                                    <span class="error-form-message">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($this->isVisitorTypeMagnitude)
                            <x-magnitude-form />
                        @else
                            <x-visitor-form />
                        @endif

                    </div>

                    <div @class(['form-group', 'hidden' => !$this->event->checkable])>
                        <label class="form-label text-black" for="">WILL BE ATTENDING TO: (May choose
                            both)</label>

                        <div class="flex flex-col space-y-2 lg:flex-row lg:space-x-3 lg:space-y-0">
                            <div>
                                <label @class([
                                    'inline-flex items-center',
                                    'cursor-not-allowed opacity-50 hidden' => !$this->event->is_online_event,
                                ])>
                                    <input @class([
                                        'h-6 w-6 border-2 border-gray-300 text-black focus:border-gray-300 focus:ring-black',
                                        'cursor-not-allowed opacity-50 ' => !$this->event->is_online_event,
                                    ]) type="checkbox" value="online"
                                        @disabled(!$this->event->is_online_event) wire:model.live="sessions">
                                    <span class="ml-2 text-lg font-semibold">Online
                                        {{ $this->event->detail->online_time_no_seconds }}</span>
                                </label>
                            </div>

                            <div>
                                <label @class([
                                    'inline-flex items-center',
                                    'cursor-not-allowed opacity-50 hidden' => !$this->event->is_offline_event,
                                ])>
                                    <input @class([
                                        'h-6 w-6 border-2 border-gray-300 text-black focus:border-gray-300 focus:ring-black',
                                        'cursor-not-allowed ' => !$this->event->is_offline_event,
                                    ]) type="checkbox" value="offline"
                                        wire:model.live="sessions" @disabled(!$this->event->is_offline_event)>
                                    <span class="ml-2 text-lg font-semibold">Offline
                                        {{ $this->event->detail->offline_time_no_seconds }}</span>
                                </label>
                            </div>
                        </div>

                        <div>
                            @error('sessions')
                                <span class="error-form-message">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    @if ($this->type === \App\Enums\VisitorType::MAGNITUDE->value)
                        {{-- STATUS --}}
                        {{-- @dump($this->event->is_offline_event_only) --}}
                        @if (!$this->event->is_offline_event_only)

                            <div class="form-group my-4">
                                @php
                                    $label = '';

                                    if (!$this->isOnlineSelected()) {
                                        $label = 'KETIDAKHADIRAN';
                                    } else {
                                        $label = 'KEHADIRAN';
                                    }
                                @endphp

                                <label class="form-label text-black" for="status">STATUS {{ $label }}
                                    ONLINE:</label>
                                <select id="status" required name="status" wire:model.live="status">
                                    <option value="">- PLEASE SELECT STATUS -</option>
                                    @foreach ($this->getStatusType() as $status_item)
                                        <option value="{{ $status_item->value }}"
                                            wire:key='{{ $status_item->value }}'>
                                            {{ $status_item->getLabel() }}
                                        </option>
                                    @endforeach
                                </select>
                                <div>
                                    @error('status')
                                        <span class="error-form-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            @if ($status === App\Enums\VisitorStatusType::SUBSTITUTE->value)
                                {{-- SUBSTITUTED BY --}}
                                <div class="form-group">
                                    <label class="form-label text-black" for="substituted_by">Substituted by: </label>
                                    <input class="w-full border border-black p-2" id="substituted_by" required
                                        type="text" wire:model.blur="substituted_by" />
                                    <div>
                                        @error('substituted_by')
                                            <span class="error-form-message">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            @endif

                        @endif

                    @endif

                    @if ($this->isOfflineSelected === true)

                        <div>

                            <div class="block border-b border-dashed border-black pb-2 text-xl lg:border-b-0 lg:pb-0">
                                <div class="flex w-36 items-center space-x-4">
                                    <label for="">
                                        <img class="max-w-10" src="{{ asset('img/icons/pinpoint.png') }}"
                                            alt="">
                                    </label>
                                    <label class="text-lg font-bold leading-none text-black">
                                        OFFLINE MEETING LOCATION
                                    </label>
                                </div>

                                <div class="my-2 text-base font-semibold">
                                    {!! $this->event->detail->offline_address !!}
                                </div>

                            </div>

                            @if (count($this->offline_foods))
                                <div class="flex flex-col gap-y-4 pt-2">
                                    {{-- PAKET MAKANAN + MINUMAN IDR 150.000 --}}
                                    <div class="my-2 flex flex-col gap-y-1">

                                        {{-- TODO: clean this after event finish --}}
                                        @if ($this->event->slug != 'fun-bay-networking')
                                            <div class="flex w-36 items-center space-x-4">
                                                <label for="">
                                                    <img class="max-w-10" src="{{ asset('img/icons/spoon.png') }}"
                                                        alt="">
                                                </label>
                                                <label class="text-lg font-bold leading-none text-black" for="food">

                                                    PAY FOR YOUR LUNCH

                                                </label>

                                            </div>
                                        @endif

                                        @if ($this->event->detail->food_type === App\Enums\FoodType::BUFFET->value)

                                            {{-- ? Buffet food type --}}
                                            {{-- ! TODO: Refactor to component and clean up --}}
                                            @if (count($this->offline_foods) === 1)
                                                <input
                                                    class="w-full border border-black p-2 font-extrabold disabled:bg-gray-500"
                                                    id="food" type="text" wire:model="food"
                                                    wire:init='food = "{{ $this->offline_foods[0]['food'] }}"'
                                                    readonly />
                                            @else
                                                @foreach ($this->offline_foods as $key => $item)
                                                    <div
                                                        class="flex w-full items-center gap-x-4 border border-black p-2 font-extrabold disabled:bg-gray-500">
                                                        <input id="food-{{ $key }}" type="checkbox"
                                                            value="{{ $item['food'] }}" wire:model="food" />
                                                        <label class="flex-grow"
                                                            for="food-{{ $key }}">{{ $item['food'] }}</label>
                                                    </div>
                                                @endforeach
                                            @endif
                                        @else
                                            {{-- ? Ala Carte food type --}}

                                            {{-- ? ala carte foods --}}

                                            @if (count($this->offline_foods[0]['food']))

                                                @if (count($this->offline_foods[0]['food']) === 1)
                                                    <input
                                                        class="w-full border border-black p-2 font-extrabold disabled:bg-gray-500"
                                                        id="food" type="text" wire:model="food.food"
                                                        wire:init='food.food = "{{ $this->offline_foods[0]['food'][0] }}"'
                                                        readonly />
                                                @else
                                                    <select id="food" name="food" wire:model="food.food">
                                                        <option required value="">- PLEASE SELECT FOOD -</option>

                                                        @foreach ($this->offline_foods[0]['food'] as $food)
                                                            <option value="{{ $food }}">
                                                                {{ $food }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            @endif

                                            {{-- ? ala carte drinks --}}
                                            @if (count($this->offline_foods[0]['drink']))

                                                @if (count($this->offline_foods[0]['drink']) === 1)
                                                    <input
                                                        class="w-full border border-black p-2 font-extrabold disabled:bg-gray-500"
                                                        id="food" type="text" wire:model="food.drink"
                                                        wire:init='food.drink = "{{ $this->offline_foods[0]['drink'][0] }}"'
                                                        readonly />
                                                @else
                                                    <select id="drink" required name="drink"
                                                        wire:model="food.drink">
                                                        <option value="">- PLEASE SELECT DRINK -</option>
                                                        @foreach ($this->offline_foods[0]['drink'] as $drink)
                                                            <option value="{{ $drink }}">
                                                                {{ $drink }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                @endif
                                            @endif

                                            {{-- ? ala carte drinks end --}}
                                        @endif

                                        <div>
                                            @error('food')
                                                <span class="error-form-message">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        {{-- KETERANGAN --}}
                                        @if ($this->event->detail->show_invoice_upload)

                                            {{-- <p class="font-semibold">Please transfer payment to <br><strong
                                                    class="text-lg">Fransisca - BCA 0657181513</strong></p> --}}

                                            <p class="font-semibold">Please transfer payment to <br><strong
                                                    class="text-lg">BANK JAGO 1005 2218 1069 a/n Fransisca</strong></p>

                                            <div class="rounded-lg bg-gray-200 p-2">
                                                <p class="mb-2">Sertakan Berita dengan format penulisan:
                                                    {{-- TODO: CLEAN THIS AFTER EVENT END --}}
                                                    <strong>“Chapter/Visitor" + “Nama" @if ($this->event->slug == 'fun-bay-networking')
                                                            + APR22
                                                        @endif </strong>
                                                </p>
                                                <p>Contoh:</p>

                                                @if ($this->event->slug == 'fun-bay-networking')
                                                    <ul class="list-inside list-disc pl-1 lg:pl-2">
                                                        <li class="font-semibold">Magnitude Deddy + APR22</li>
                                                        <li class="font-semibold">Altitude Edo + APR22</li>
                                                        <li class="font-semibold">Visitor Daniel + APR22</li>
                                                    </ul>
                                                @else
                                                    <ul class="list-inside list-disc pl-1 lg:pl-2">
                                                        <li class="font-semibold">Magnitude Deddy</li>
                                                        <li class="font-semibold">Altitude Edo</li>
                                                        <li class="font-semibold">Visitor Daniel</li>
                                                    </ul>
                                                @endif
                                            </div>

                                            {{-- UPLOAD BUKTI PEMBAYARAN --}}
                                            <div class="form-group">
                                                <label class="form-label text-black" for="payment">UPLOAD PROOF OF
                                                    PAYMENT:</label>
                                                <input class="w-full border border-black p-2" id="payment"
                                                    type="file" accept="image/*" wire:model.live='payment'
                                                    name="payment" />
                                                @if ($payment)
                                                    <div class="bg-gray my-3 px-2">
                                                        <img class="w-full max-w-screen-lg lg:max-w-sm"
                                                            src="{{ $payment->temporaryUrl() }}" alt="">
                                                    </div>
                                                @endif
                                                {{-- <x-filepond::upload wire:model="payment" required="{{ $this->isOfflineSelected }}" /> --}}

                                                <div>
                                                    @error('payment')
                                                        <span class="error-form-message">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        @endif
                                    </div>



                                </div>
                            @endif
                        </div>

                    @endif

                    <div class="mt-4 flex justify-center">



                        <button class="btn disabled:hover: w-full bg-red-bni disabled:bg-red-bni/80"
                            wire:loading.attr="disabled" type="submit">
                            <span class="items-center justify-center" wire:loading.flex wire:target="save">
                                <svg class="-ml-1 mr-3 h-5 w-5 animate-spin text-white" data-motion-id="svg 2"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="4">
                                    </circle>
                                    <path class="opacity-75" fill="currentColor"
                                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                    </path>
                                </svg>
                                Processing...
                            </span>

                            <span wire:loading.remove wire:target="save">
                                COMPLETE REGISTRATION</span>
                        </button>



                    </div>

                </form>
            </div>
        @else
            <div class="flex w-full max-w-full flex-col space-y-4 px-4 py-4 lg:max-w-screen-md lg:px-2">
                {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

                <div>

                    <img class="mb-6 max-w-48 lg:max-w-[300px]" src="{{ asset('img/logo_bni.jpg') }}"
                        alt="">

                    @if (!$this->isOnlineSelected && !$this->isOfflineSelected)
                        <div class="mb-6">
                            <h2 class="mb-2 text-[40px] font-bold leading-none lg:text-[78px]">
                                THANK YOU
                            </h2>
                            <h2 class="text-[40px] font-medium leading-none lg:text-[42px]">
                                FOR YOUR RESPONSE
                            </h2>
                        </div>
                    @else
                        <div class="mb-6">
                            <h2 class="mb-2 text-[40px] font-bold leading-none lg:text-[78px]">
                                THANK YOU
                            </h2>
                            <h2 class="text-[40px] font-medium leading-none lg:text-[42px]">
                                FOR YOUR REGISTRATION
                            </h2>
                        </div>

                        <h2 class="text-[24px] text-xl font-bold">
                            SEE YOU ON {{ $this->event->start_date_full_formatted }}!
                        </h2>
                    @endif
                </div>

                <div class="grid grid-cols-1">
                    @if ($this->isOnlineSelected)
                        <div class="space-y-4 border border-black px-4 py-4 lg:px-6">
                            <h4 class="text-xl font-bold lg:text-2xl">
                                ONLINE ZOOM MEETING {{ $this->event->detail->online_time_no_seconds }}
                            </h4>
                            <div>
                                <h5 class="text-lg font-bold text-gray-800 lg:text-xl">LINK ZOOM</h5>
                                <h4 class="text-xl font-bold lg:text-2xl">
                                    <a href="{{ $this->event->detail->online_link }}">
                                        {{ $this->event->detail->online_link }}
                                    </a>
                                </h4>
                            </div>

                            <div>
                                <h5 class="text-xl font-bold text-gray-800">PASSWORD</h5>
                                <h4 class="text-xl font-bold lg:text-2xl">
                                    {{ $this->event->detail->online_password }}
                                </h4>

                                <div class="mt-6">
                                    <h5 class="mb-2 text-lg font-bold">WHAT TO PREPARE</h5>
                                    <ul class="list-inside list-disc">
                                        @if ($this->event->slug != 'fun-bay-networking')
                                            <li class="text-lg font-medium">Wear Business Attire</li>
                                        @endif
                                        <li class="text-lg font-medium">Use Quality Internet Connection, Headset &
                                            Webcam</li>
                                        <li class="text-lg font-medium">Prepare Your Business Introduction</li>
                                        <li class="text-lg font-medium">Please be On-Cam all the time</li>
                                        <li class="text-lg font-medium">Use provided Zoom Meeting Background</li>
                                    </ul>
                                </div>
                            </div>

                            <a class="btn bg-red-bni text-center" target="_blank" rel="noreferrer noopener"
                                href="https://drive.google.com/drive/folders/1tJ4z08SV7Pd3d3n5q06UTmeiXFIV2RuZ"
                                download>
                                DOWNLOAD ZOOM MEET BACKGROUND
                            </a>

                        </div>
                    @endif

                    @if ($this->isOfflineSelected)
                        <div class="space-y-4 border border-black px-4 py-4 lg:px-6">
                            <h4 class="text-xl font-bold lg:text-2xl">
                                OFFLINE MEETING {{ $this->event->detail->offline_time_no_seconds }}
                            </h4>

                            <div>
                                <h5 class="text-lg font-bold text-gray-800">LOCATION:</h5>
                                {!! $this->event->detail->offline_address !!}
                            </div>

                            <a class="btn bg-red-bni" href="{{ $this->event->detail->offline_location }}"
                                target="blank">
                                GOOGLE MAP
                            </a>

                            {{-- PACKAGE SELECTED --}}
                            <div>

                                <div>
                                    <h5 class="text-lg font-bold text-gray-800">PAKET MAKANAN + MINUMAN</h5>
                                    <h4 class="text-xl font-bold lg:text-2xl">
                                        {{ $this->visitor->package }}
                                    </h4>
                                </div>

                                {{-- ORDER ID --}}
                                <div>
                                    <h5 class="text-lg font-bold text-gray-800">ORDER ID:</h5>
                                    <h4 class="text-xl font-bold lg:text-2xl">
                                        #{{ $this->visitor->order_id }}
                                    </h4>
                                </div>

                                {{-- PAYMENT --}}
                                <div class="mt-6">
                                    <h5 class="mb-2 text-lg font-bold">WHAT TO PREPARE</h5>
                                    <ul class="list-inside list-disc">
                                        @if ($this->event->slug != 'fun-bay-networking')
                                            <li class="text-lg font-medium">Wear Business Attire</li>
                                        @endif

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
