<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Booking,
    Package,
    Hotel,
    ThingToDo,
    Event,
    Transport
};

class DashboardController extends Controller
{
    public function index()
    {


        $stats = [
            'booking' => Booking::count(),
            'booking_status' => Booking::selectRaw('status, COUNT(*) as total')
                ->groupBy('status')
                ->pluck('total', 'status'),
            'packages' => [
                'total'  => Package::count(),
                'active' => Package::where('status', 'active')->count(),
            ],

            'hotels' => Hotel::count(),

            'todos' => ThingToDo::count(),

            'events' => Event::count(),

            'transports' => Transport::count(),
        ];

        return view('backend.admin.dashboard', compact('stats'));
    }
}
