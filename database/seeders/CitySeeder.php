<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\{
    City,
    Image
};

class CitySeeder extends Seeder
{
    public function run(): void
    {
        $languages = ['en', 'de', 'fr'];

        // 🔍 Detect legacy image column
        $imageColumns = Schema::getColumnListing('images');

        $imageField =
            in_array('image', $imageColumns) ? 'image' :
            (in_array('file', $imageColumns) ? 'file' :
            (in_array('filename', $imageColumns) ? 'filename' : null));

        City::factory()
            ->count(5)
            ->create()
            ->each(function (City $city) use ($languages, $imageField) {

                /* ----------------------------
                 | Translations
                 |-----------------------------*/
                foreach ($languages as $lang) {
                    $city->translations()->firstOrCreate(
                        ['language_code' => $lang],
                        [
                            'name' => ucfirst($city->slug),
                            'tagline' => "Discover {$city->slug}",
                            'about' => "About {$city->slug} in {$lang}",
                        ]
                    );
                }

                /* ----------------------------
                 | Gallery Images (LEGACY SAFE)
                 |-----------------------------*/
                if ($imageField) {
                    foreach ([1, 2, 3] as $i) {
                        Image::create([
                            $imageField => "cities/{$city->slug}/gallery{$i}.jpg",
                            'imageable_id' => $city->id,
                            'imageable_type' => City::class,
                        ]);
                    }
                }
            });
    }
}
