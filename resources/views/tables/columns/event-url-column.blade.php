<div>
    @if ($getRecord()->detail)
        <a href="{{ route('event.show', ['slug' => $getRecord()->slug]) }}" class="text-blue-500 hover:text-blue-700">Buka Halaman</a>
    @else
        <span class="text-muted text-sm">-</span>
    @endif
</div>
