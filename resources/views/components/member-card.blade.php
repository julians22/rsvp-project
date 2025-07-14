@props(['member'])

<div class="group aspect-[9/16] overflow-clip rounded-3xl bg-white pb-4 shadow-lg">
    <div class="bg-red-bni p-4">
        <h3 class="min-h-8 text-lg font-semibold uppercase text-white">
            {{ $member->industry }}
        </h3>

        <div
            class="aspect-squares relative z-0 z-0 -mb-[45%] text-center transition-transform duration-300 group-hover:scale-110">
            <img class="mx-auto" draggable="false" src="{{ $member->getFirstMediaUrl('profile_photo') }}"
                alt="{{ $member->name }} profile photo">
        </div>
    </div>

    <div class="relative z-10 mt-14 flex flex-col gap-4 p-4 px-6">
        <p class="text-xl font-bold text-bni-gold-dark">
            {{ $member->name }}
        </p>

        <ul class="flex flex-col gap-2 text-xs">
            <li class="flex items-center gap-2">
                <div class="basis-6 bg-red-bni p-1">
                    <x-lucide-mail class="size-full text-white" />
                </div>
                <a class="break-all" href="mailto:{{ $member->email }}">{{ $member->email }}</a>
            </li>

            @if ($member->social)
                <li class="flex items-center gap-2">
                    <div class="basis-6 bg-red-bni p-1">
                        <x-lucide-instagram class="size-full text-white" />
                    </div>
                    <a class="break-all" target="_blank"
                        href="{{ filter_var($member->social, FILTER_VALIDATE_URL) ? $member->social : 'https://' . $member->social }}">{{ $member->social_label ?? $member->social }}</a>
                </li>
            @endif

            @if ($member->website)
                <li class="flex items-center gap-2">
                    <div class="basis-6 bg-red-bni p-1">
                        <x-lucide-globe class="size-full text-white" />
                    </div>
                    <a class="break-all" target="_blank"
                        href="{{ filter_var($member->website, FILTER_VALIDATE_URL) ? $member->website : 'https://' . $member->website }}">{{ $member->website_label ?? $member->website }}</a>
                </li>
            @endif
        </ul>

        @if ($member->getFirstMediaUrl('company_logo'))
            <div>
                <img class="mr-auto max-w-[min(80%,100px)]" src="{{ $member->getFirstMediaUrl('company_logo') }}"
                    alt="{{ $member->name }} Company logo">
            </div>
        @endif

        <p>
            {{ $member->company }}
        </p>

    </div>
</div>
