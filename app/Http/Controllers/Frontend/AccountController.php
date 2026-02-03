<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Traveller;


class AccountController extends Controller
{
    public function index()
    {
        return view('frontend.account.index');
    }

    public function loadTab(Request $request)
    {
        $tab = $request->get('tab', 'dashboard');
       
        return match ($tab) {
            'dashboard' => view('frontend.account.tabs.dashboard', [
                'stats' => Booking::where('user_id', auth()->user()->id)
                    ->selectRaw('
                        COUNT(*) as total_bookings,
                        SUM(status = "completed") as completed_bookings,
                        SUM(status = "cancelled") as cancelled_bookings,
                        SUM(status IN ("pending", "confirmed")) as upcoming_bookings
                    ')
                    ->first()
            ]),
            'profile'   => view('frontend.account.tabs.profile', [
                'user' => auth()->user(),
                'profileImage' => auth()->user()->profileImage ?? null
            ]),
            'bookings'  => view('frontend.account.tabs.bookings'),
            'addresses' => view('frontend.account.tabs.addresses', [
                                'addresses' => UserAddress::where('user_id', auth()->id())->latest()->get()
                            ]),
            'travellers' => view('frontend.account.tabs.travellers', [
                'travellers' => Traveller::where('user_id', auth()->id())
                ->latest()
                ->get()
            ]),
            'wishlist'  => view('frontend.account.tabs.wishlist'),
            default     => abort(404),
        };


        return view('frontend.account.tabs.travellers', compact('travellers'));
    }
}
