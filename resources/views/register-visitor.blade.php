@extends('layouts.app')


@section('page')
    <div class="flex justify-center min-h-screen pb-14">
        <div class="max-w-screen-sm flex flex-col space-y-4 py-4 px-4 lg:px-2">
            <div>
                <h1 class="text-4xl font-extrabold text-blue-950 mb-2">
                    BNI VISITOR INFORMATION MEETING
                </h1>

                <h2 class="text-2xl font-bold text-black">5 NOVEMBER 2024</h2>
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
                    <input type="text" id="name" class="w-full border border-black p-2" />
                </div>

                {{-- Klasifikasi Bisnis --}}
                <div
                    class="flex flex-col gap-y-1"
                >
                    <label for="business" class="text-lg text-black">KLASIFIKASI BISNIS:</label>
                    <input type="text" id="business" class="w-full border border-black p-2" />
                </div>

                {{-- Nama Perusahaan --}}
                <div
                    class="flex flex-col gap-y-1"
                >
                    <label for="company" class="text-lg text-black">NAMA PERUSAHAAN:</label>
                    <input type="text" id="company" class="w-full border border-black p-2" />
                </div>

                {{-- NO HANDPHONE / WHATSAPP --}}
                <div
                    class="flex flex-col gap-y-1"
                >
                    <label for="phone" class="text-lg text-black">NO HANDPHONE / WHATSAPP:</label>
                    <input type="text" id="phone" class="w-full border border-black p-2" />
                </div>

                {{-- EMAIL --}}
                <div
                    class="flex flex-col gap-y-1"
                >
                    <label for="email" class="text-lg text-black">EMAIL:</label>
                    <input type="email" id="email" class="w-full border border-black p-2" />
                </div>

                {{-- DIUNDANG OLEH: (Nama + Chapter) --}}
                <div
                    class="flex flex-col gap-y-1"
                >
                    <label for="invited_by" class="text-lg text-black">DIUNDANG OLEH: (Nama + Chapter):</label>
                    <input type="text" id="invited_by" class="w-full border border-black p-2" />
                </div>

                <div class="flex flex-col gap-y-1">
                    <label for="" class="text-lg text-black">DATANG KE MEETING: (bisa pilih 22nya)</label>

                    <div class="flex space-x-3">
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="session" value="online" class="border-gray-300 border-2 text-black focus:border-gray-300 focus:ring-black" checked="">
                                <span class="ml-2">Online 7.30 Pagi</span>
                            </label>
                        </div>
                        <div>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="session" value="offline" class="border-gray-300 border-2 text-black focus:border-gray-300 focus:ring-black">
                                <span class="ml-2">Offine 11.00 Siang</span>
                            </label>
                        </div>
                    </div>

                </div>

            </div>

            <div>
                <p class="font-bold text-black text-xl">
                    OFFLINE MEETING VENUE
                    Rumah Koffie,
                    Jl. Rasuna Said 123,
                    Jakarta Barat
                </p>
            </div>

            <div class="flex flex-col gap-y-4">

                {{-- PAKET MAKANAN + MINUMAN IDR 150.000 --}}
                <div
                    class="flex flex-col gap-y-1"
                >
                    <label for="food" class="text-lg text-black">PAKET MAKANAN + MINUMAN IDR 150.000:</label>
                    <select name="food" id="food">
                        <option value="a">Paket A = Spaghetti + Es teh</option>
                        <option value="b">Paket B = Nasi Goreng + Kopi</option>
                        <option value="c">Paket C = Mie Ayam + Teh Manis</option>
                    </select>

                </div>

                {{-- KETERANGAN --}}
                <p>Please transfer to <strong>Jessica Cynthia Dewi - BCA 8790178689</strong></p>

                {{-- UPLOAD BUKTI PEMBAYARAN --}}

                <div
                    class="flex flex-col gap-y-1"
                >

                    <label for="payment" class="text-lg text-black">UPLOAD BUKTI PEMBAYARAN:</label>
                    <input type="file" id="payment" class="w-full border border-black p-2" />
                </div>

            </div>

            <div class="flex justify-center">
                <button class="bg-black text-white px-4 py-2 w-full">SUBMIT</button>
            </div>

        </div>
    </div>
@endsection
