@props(['events'])

<div class="grid grid-cols-1 gap-4 md:hidden">
    @foreach ($events as $event)
        <x-event-card :event="$event" :date="false" />
    @endforeach
</div>
