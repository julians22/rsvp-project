<form wire:submit="save">
    <div class="max-w-screen-sm flex flex-col space-y-4 py-4 px-4 lg:px-2">
        {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

        <div class="px-4 py-2 bg-red-500 text-white text-center transition-all ease-in-out rounded sticky top-0" wire:offline>
            <p class="text-bold">Perangkat anda sedang Offline</p>
        </div>

        <div>
            <h1 class="text-4xl font-extrabold text-blue-950 mb-2">
                BNI VISITOR INFORMATION MEETING
            </h1>

            <h2 class="text-2xl font-bold text-black">
                {{ $this->event->start_date }}
            </h2>
        </div>

        <div>
            <small>NOTES:</small>
            <p class="font-bold text-black text-xl">
                REGISTRASI DITUTUP H-1
                JAM 18.00 WIB
            </p>
        </div>


        <div class="flex flex-col gap-y-4">

            {{-- NAMA LENGKAP --}}
            <div
                class="flex flex-col gap-y-1"
            >
                <label for="name" class="text-lg text-black">NAMA LENGKAP:</label>
                <input type="text" id="name" wire:model.blur="name" class="w-full border border-black p-2" />
                <div>
                    @error('name') <span class="error-form-message">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Klasifikasi Bisnis --}}
            <div
                class="flex flex-col gap-y-1"
            >
                <label for="business" class="text-lg text-black">KLASIFIKASI BISNIS:</label>
                <input type="text" id="business" wire:model='business' class="w-full border border-black p-2" />
                <div>
                    @error('business') <span class="error-form-message">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Nama Perusahaan --}}
            <div
                class="flex flex-col gap-y-1"
            >
                <label for="company" class="text-lg text-black">NAMA PERUSAHAAN:</label>
                <input type="text" id="company" wire:model='company' class="w-full border border-black p-2" />
                <div>
                    @error('company') <span class="error-form-message">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- NO HANDPHONE / WHATSAPP --}}
            <div
                class="flex flex-col gap-y-1"
            >
                <label for="phone" class="text-lg text-black">NO HANDPHONE / WHATSAPP:</label>
                <input type="tel" id="phone" wire:model='phone' class="w-full border border-black p-2" />
                <div>
                    @error('phone') <span class="error-form-message">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- EMAIL --}}
            <div
                class="flex flex-col gap-y-1"
            >
                <label for="email" class="text-lg text-black">EMAIL:</label>
                <input type="email" wire:model='email' id="email" class="w-full border border-black p-2" />
                <div>
                    @error('email') <span class="error-form-message">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- DIUNDANG OLEH: (Nama + Chapter) --}}
            <div
                class="flex flex-col gap-y-1"
            >
                <label for="invited_by" class="text-lg text-black">DIUNDANG OLEH: (Nama + Chapter):</label>
                <input type="text" wire:model='invited_by' id="invited_by" class="w-full border border-black p-2" />
                <div>
                    @error('invited_by') <span class="error-form-message">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="flex flex-col gap-y-1">
                <label for="" class="text-lg text-black">DATANG KE MEETING:</label>

                <div class="flex space-x-3">
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="sessions" value="online" wire:model.live="sessions" class="border-gray-300 border-2 text-black focus:border-gray-300 focus:ring-black rounded-full" checked="">
                            <span class="ml-2">Online {{ $this->online_hour }} Pagi</span>
                        </label>
                    </div>
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="sessions" value="offline" wire:model.live="sessions" class="border-gray-300 border-2 text-black focus:border-gray-300 focus:ring-black rounded-full">
                            <span class="ml-2">Offine {{ $this->offline_hour }} Siang</span>
                        </label>
                    </div>


                </div>

            </div>

        </div>

        @if ($this->isOfflineSelected)


        <div>
            {!! $this->event->detail->offline_address !!}
        </div>

        <div class="flex flex-col gap-y-4">

            {{-- PAKET MAKANAN + MINUMAN IDR 150.000 --}}
            <div
                class="flex flex-col gap-y-1"
            >
                <label for="food" class="text-lg text-black">PAKET MAKANAN + MINUMAN IDR 150.000:</label>
                <select name="food" id="food" wire:model='food'>
                    @foreach ($this->offline_foods as $item)
                        <option value="@json($item)">
                            {{ $item['food'] }} - {{ $item['drink'] }}
                        </option>
                    @endforeach
                </select>

            </div>

            {{-- KETERANGAN --}}
            <p>Please transfer to <strong>Jessica Cynthia Dewi - BCA 8790178689</strong></p>

            {{-- UPLOAD BUKTI PEMBAYARAN --}}

            <div
                class="flex flex-col gap-y-1"
            >

                <label for="payment" class="text-lg text-black">UPLOAD BUKTI PEMBAYARAN:</label>
                <input type="file" wire:model='payment' name="payment" id="payment" class="w-full border border-black p-2" />
            </div>

        </div>

        @endif

        <div class="flex justify-center">
            <button class="bg-black text-white px-4 py-2 w-full" type="submit">SUBMIT</button>
        </div>

    </div>
</form>
