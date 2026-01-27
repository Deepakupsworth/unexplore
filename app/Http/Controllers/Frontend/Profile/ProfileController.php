<?php

namespace App\Http\Controllers\Frontend\Profile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


 class ProfileController extends Controller
    {
        public function index()
        {
            echo 'ff';
            $user = Auth::user();
            $profileImage = $user->profileImage;

            return view('frontend.profile',compact('user','profileImage'));
        }

        public function update(Request $request)
        {
            $request->validate([
                'first_name'    => 'required|string|max:100',
                'last_name'     => 'required|string|max:100',
                'phone'  => 'required|string|max:20',
                'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            $user = Auth::user();

            /* =========================
               UPDATE BASIC INFO
            ========================== */
            $user->update([
                'first_name'   => $request->first_name,
                'last_name'    => $request->last_name,
                'phone' => $request->phone,
            ]);

            /* =========================
               SAVE PROFILE PHOTO (THUMB)
               SAME STYLE AS HOTEL LOGIC
            ========================== */
            if ($request->hasFile('profile_photo')) {

                // Delete old thumb
                if ($user->profileImage) {
                    Storage::disk('public')->delete($user->profileImage->image_path);
                    $user->profileImage()->delete();
                }

                // Store new thumb using helper
                storeImage(
                    $user,                          // imageable model
                    $request->profile_photo,        // file
                    'profiles/thumbs',              // folder
                    'thumb',                        // role
                    null,                           // language_code
                    true                            // is_primary
                );
            }

            return back()->with('success', 'Profile updated successfully.');
        }

    }
