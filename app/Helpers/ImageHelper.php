<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

if (!function_exists('storeImage')) {

    /**
     * Store image for any model (polymorphic)
     *
     * @param  Model         $model
     * @param  UploadedFile  $file
     * @param  string        $folder
     * @param  string        $role       thumb|gallery|banner|icon
     * @param  string|null   $language
     * @param  bool          $isPrimary
     * @param  int           $sortOrder
     * @return Image
     */
    function storeImage(
        $model,
        UploadedFile $file,
        string $folder,
        string $role = 'gallery',
        ?string $language = null,
        bool $isPrimary = false,
        int $sortOrder = 0
    ) {
        // Generate unique file name
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();

        // Store image (public disk)
        $path = $file->storeAs($folder, $filename, 'public');

        // If thumb/banner → keep only one
        if (in_array($role, ['thumb', 'banner'])) {
            $model->images()
                ->where('role', $role)
                ->where('language_code', $language)
                ->delete();
        }

        // Save image record
        return $model->images()->create([
            'image_path'   => $path,
            'role'         => $role,
            'language_code'=> $language,
            'is_primary'   => $isPrimary,
            'sort_order'   => $sortOrder,
        ]);
    }
}
