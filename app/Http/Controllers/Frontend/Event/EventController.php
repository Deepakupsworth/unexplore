<?php

namespace App\Http\Controllers\Frontend\Event;

use App\Http\Controllers\Controller;

abstract class EventController extends Controller
{
    public function index(){
        return view('frontend.event-listing');
    }

    public function event_details(){
        return view('event-details');
    }
}
