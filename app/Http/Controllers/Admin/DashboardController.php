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
use DB;

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
                        'statusData' => DB::table('bookings')
                        ->selectRaw('status, COUNT(*) as total')
                        ->groupBy('status')
                        ->pluck('total', 'status'),

            'monthBookingsChart'=> DB::table('bookings')
                        ->selectRaw('MONTH(created_at) as month, COUNT(*) as total')
                        ->groupBy('month')
                        ->orderBy('month')
                        ->pluck('total','month')
        ];
        
        return view('backend.admin.dashboard', compact('stats'));
    }
}
