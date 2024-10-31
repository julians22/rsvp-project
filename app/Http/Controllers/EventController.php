<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    function show($slug)
    {
        return view('visitors.landing', ['slug' => $slug]);

        // return view('register-visitor', ['slug' => $slug]);
    }
}
