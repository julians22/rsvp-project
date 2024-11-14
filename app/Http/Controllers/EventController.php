<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    function show($slug)
    {
        $isDisabled = false;
        $event = Event::with('detail')->where('slug', $slug)->first();

        if ($event == null) {
            abort(404);
        }

        if ($event->detail == null || $event->detail->online_link == null) {
            abort(404);
        }

        if ($event->isEnded()) {
            $isDisabled = true;
        }

        return view('visitors.landing', [
            'slug' => $slug,
            'event' => $event,
            'isDisabled' => $isDisabled,
            'is_offline_event' => str_contains($slug, 'offline')
        ]);
    }

    function register($slug)
    {
        $event = Event::with('detail')->where('slug', $slug)->first();

        // if ($event == null) {
        //     abort(404);
        // }

        // if ($event->detail == null || $event->detail->online_link == null) {
        //     abort(404);
        // }

        // if ($event->isEnded()) {
        //     return redirect()->route('event.show', $slug);
        // }

        return view('register-visitor', ['slug' => $slug, 'event' => $event]);
    }
}
