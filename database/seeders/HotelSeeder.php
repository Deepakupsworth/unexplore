<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Hotel;
use App\Models\HotelTranslation;
use App\Models\Language;
use App\Models\Image;

class HotelSeeder extends Seeder
{
    public function run(): void
    {
        // 🔥 language codes from existing languages table
        $languageCodes = Language::pluck('code')->toArray();

        City::all()->each(function ($city) use ($languageCodes) {

            Hotel::factory()
                ->count(rand(6, 7)) // 6–7 hotels per city
                ->create(['city_id' => $city->id])
                ->each(function ($hotel) use ($languageCodes) {

                    /* =========================
                       HOTEL TRANSLATIONS
                    ========================== */
                    foreach ($languageCodes as $code) {
                        HotelTranslation::factory()->create([
                            'hotel_id'      => $hotel->id,
                            'language_code' => $code,
                            'name'          => fake()->company . ' Hotel (' . strtoupper($code) . ')',
                        ]);
                    }

                    /* =========================
                       THUMB IMAGE (1)
                    ========================== */
                    Image::factory()->create([
                        'imageable_id'   => $hotel->id,
                        'imageable_type' => Hotel::class,
                        'role'           => 'thumb',
                        'is_primary'     => true,
                        'sort_order'     => 0,
                        'image_path'     => 'hotels/'.$hotel->id.'/thumb.jpg',
                    ]);

                    /* =========================
                       GALLERY IMAGES (4–6)
                    ========================== */
                    $galleryCount = rand(4, 6);

                    for ($i = 1; $i <= $galleryCount; $i++) {
                        Image::factory()->create([
                            'imageable_id'   => $hotel->id,
                            'imageable_type' => Hotel::class,
                            'role'           => 'gallery',
                            'sort_order'     => $i,
                            'image_path'     => 'hotels/'.$hotel->id.'/gallery_'.$i.'.jpg',
                        ]);
                    }

                });
        });
    }
}
