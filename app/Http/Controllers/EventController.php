<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    function index()
    {

        $events = Event::with('detail')->incoming()->orderBy('start_date')->get();

        // Modulus events on 3
        $skeletonsCount = 3 - count($events) % 3;

        if ($skeletonsCount == 3) {
            $skeletonsCount = 0;
        }

        return view('events', ['events' => $events, 'skeletonsCount' => $skeletonsCount]);
    }

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

        if (!$event->detail->enable_registration) {
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

        if ($event == null) {
            abort(404);
        }

        if ($event->detail == null || $event->detail->online_link == null) {
            abort(404);
        }

        if ($event->isEnded()) {
            return redirect()->route('event.show', $slug);
        }

        if (!$event->detail->enable_registration) {
            return redirect()->route('event.show', $slug);
        }

        return view('register-visitor', ['slug' => $slug, 'event' => $event]);
    }
}
