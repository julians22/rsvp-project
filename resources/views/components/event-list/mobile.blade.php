@props(['events'])

<div class="grid grid-cols-1 gap-4 md:hidden">
    @foreach ($events as $event)
        <x-event-list.card :event="$event" />
    @endforeach
</div>
