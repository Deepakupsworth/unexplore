<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Store new address (AJAX)
     */
    public function store(Request $request)
    {
        $request->validate([
            'address_title' => 'required|string|max:100',
            'city'          => 'required|string|max:100',
            'pin_code'      => 'required|string|max:20',
            'full_address'  => 'required|string|max:500',
            'country'       => 'required|string|max:100',
        ]);

        UserAddress::create([
            'user_id'       => auth()->id(),
            'address_title' => $request->address_title,
            'city'          => $request->city,
            'pin_code'      => $request->pin_code,
            'full_address'  => $request->full_address,
            'country' =>$request->country
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address added successfully',
        ]);
    }

    /**
     * Get single address (for edit / view modal)
     */
    public function show($id)
    {
        $address = UserAddress::where('user_id', auth()->id())
            ->findOrFail($id);

        return response()->json($address);
    }

    /**
     * Update address (AJAX)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'address_title' => 'required|string|max:100',
            'city'          => 'required|string|max:100',
            'pin_code'      => 'required|string|max:20',
            'full_address'  => 'required|string|max:500',
        ]);

        $address = UserAddress::where('user_id', auth()->id())
            ->findOrFail($id);

        $address->update([
            'address_title' => $request->address_title,
            'city'          => $request->city,
            'pin_code'      => $request->pin_code,
            'full_address'  => $request->full_address,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Address updated successfully',
        ]);
    }

    /**
     * Soft delete address
     */
    public function destroy($id)
    {
        $address = UserAddress::where('user_id', auth()->id())
            ->findOrFail($id);

        $address->delete(); // soft delete

        return response()->json([
            'success' => true,
            'message' => 'Address deleted successfully',
        ]);
    }

    /**
     * Restore soft-deleted address (optional)
     */
    public function restore($id)
    {
        $address = UserAddress::withTrashed()
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $address->restore();

        return response()->json([
            'success' => true,
            'message' => 'Address restored successfully',
        ]);
    }
}
