@props(['events'])
<div class="glide max-md:hidden" id="glide-past">
    <div class="glide__track mx-8 md:mx-16" data-glide-el="track">
        <ul class="glide__slides pb-8">
            @foreach ($events as $event)
                <x-event-card :event="$event" :date="false" />
            @endforeach
        </ul>
    </div>

    <div class="glide__arrows" data-glide-el="controls">
        <button class="glide__arrow glide__arrow--left -left-4 border-none shadow-none sm:left-0" data-glide-dir="<">
            <x-heroicon-o-arrow-left-circle class="size-8 text-black" />
        </button>

        <button class="glide__arrow glide__arrow--right -right-4 border-none shadow-none sm:right-0" data-glide-dir=">">
            <x-heroicon-o-arrow-right-circle class="size-8 text-black" />
        </button>
    </div>
</div>
