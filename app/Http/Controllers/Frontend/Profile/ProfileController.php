<?php

namespace App\Http\Controllers\Frontend\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;


class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $profileImage = $user->profileImage;
        $addresses = $user->addresses()->latest()->get();

        return view('frontend.profile', compact(
            'user',
            'profileImage',
            'addresses'
        ));
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

        return back()->with('success', __('account.updated_successfully'));
    }

    public function uploadProfileImage(Request $request)
    {
        try {
            // IMPORTANT: manual validation for AJAX
            $request->validate([
                'thumb' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ]);

            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('account.unauthenticated')
                ], 401);
            }

            // delete old image if exists
            if ($user->profileImage) {
                $user->profileImage->delete();
            }

            // store new image (using your helper)
            storeImage(
                $user,
                $request->file('thumb'),
                'users/profile',
                'thumb',
                'en',
                true
            );

            return response()->json([
                'status' => 'success',
                'message' =>  __('account.image_updated')
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                'status' => 'error',
                'message' => $e->errors()
            ], 422);
        } catch (\Throwable $e) {

            Log::error('Profile upload failed', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => __('account.server_error')
            ], 500);
        }
    }

    public function deleteProfileImage()
    {
        try {
            $user = Auth::user();

            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('account.unauthenticated')
                ], 401);
            }

            if (!$user->profileImage) {
                return response()->json([
                    'status' => 'error',
                    'message' => __('account.image_not_found')
                ], 404);
            }

            // Delete image record + file (handled by model/helper)
            $user->profileImage->delete();

            return response()->json([
                'status' => 'success',
                'message' => __('account.image_deleted')
            ]);
        } catch (\Throwable $e) {

            Log::error('Profile image delete failed', [
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => __('acount.server_error')
            ], 500);
        }
    }
}

