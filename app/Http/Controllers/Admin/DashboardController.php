<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
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
