<x-mail::message>
# YOUR BOOKING CONFIRMATION


Hi {{ $visitor->name }},

Thank you for registering to our event. Here are the details of the event you have registered for:
@if ($visitor->is_online)

- Date: {{ $visitor->event->start_date_full_formatted }}
- Time: {{ $visitor->event->detail->online_time_no_seconds }}
- Location: Online
- Admission: Free


{{-- Make Link Clickable --}}
<x-mail::button :url="$visitor->event->detail->online_link">
    Zoom Link: {{ $visitor->event->detail->online_link }}
</x-mail::button>

@endif


@if ($visitor->is_offline)

- ORDER ID : #{{ $visitor->order_id }}
- Date: {{ $visitor->event->start_date_full_formatted }}
- Time: {{ $visitor->event->detail->offline_time_no_seconds }}
- Location: {!! $visitor->event->detail->offline_address !!}

{{-- Add map url button --}}
<x-mail::button :url="$visitor->event->detail->offline_map_url">
    View Map Location
</x-mail::button>

@endif


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
