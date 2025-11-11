<section class="my-8 mt-[10%]">
    <div class="mx-auto flex w-full max-w-none flex-col px-4 lg:max-w-5xl lg:px-0">
        <x-event-list-title class="!mx-auto mb-[30%] !flex !w-full !flex-col !items-center !justify-center !text-center">
            Past events
        </x-event-list-title>
    </div>

    <div
        class="m-auto flex w-dvw flex-col items-center bg-red-bni bg-why-bni bg-cover bg-bottom bg-no-repeat px-4 py-10 text-white bg-blend-multiply max-lg:-mx-4 md:px-8 md:py-20 lg:-mx-[calc((100vw-64rem)/2)]">

        <div class="mx-auto flex w-full max-w-none flex-col px-4 lg:max-w-5xl lg:px-0">
            <div class='-mt-[35%] flex flex-col text-center'>
                <video src="{{ asset('videos/NetworkingIsFun2.mp4') }}" controls></video>
            </div>
            <div class="mt-8 flex flex-col items-center gap-6 text-center">
                <div class="mx-auto flex w-full max-w-none flex-col md:px-4 lg:max-w-5xl lg:px-0">
                    <x-event-list-title
                        class="!m-auto !mx-auto mb-[30%] !flex !w-full !flex-col !items-center !justify-center !text-center !text-2xl font-bold uppercase text-white after:!bg-white md:!text-5xl">
                        Business networking can be fun
                    </x-event-list-title>
                </div>

                <p class="text-white/70">
                    At BNI Magnitude, growth goes beyond business — it’s about building genuine connections. Here,
                    business owners network, collaborate, and promote their ventures through regular events and fun
                    activities. From padel, karaoke, golf, breakfast, lunch, dinner, to casual hangouts, BNI
                    Magnitude
                    combines productive business networking with an enjoyable, friendly atmosphere.
                </p>
                <p>
                    Because in BNI Magnitude, we believe success grows faster
                    when you’re having fun together.
                </p>
                <a class="w-fit bg-bni-gold px-4 py-2 font-bold uppercase text-black hover:bg-bni-gold-dark"
                    href="{{ asset('BNI Magnitude - Chapter Roster Oct 2025.pdf') }}"
                    download="BNI Magnitude - Chapter Roster Oct 2025.pdf">
                    Download Chapter Roster
                </a>
            </div>
        </div>
    </div>

</section>
