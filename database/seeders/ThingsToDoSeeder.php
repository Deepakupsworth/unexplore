<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ThingToDo;
use App\Models\ThingToDoTranslation;
use App\Models\Image;

class ThingsToDoSeeder extends Seeder
{
    public function run(): void
    {
        $languages = ['en', 'ar', 'de'];

        ThingToDo::factory(25)->create()->each(function ($thing) use ($languages) {

            // 🌍 Translations
            foreach ($languages as $lang) {
                ThingToDoTranslation::create([
                    'thing_id'      => $thing->id,
                    'language_code' => $lang,
                    'name'          => ucfirst($lang).' '.$thing->slug,
                    'about'         => "Description in {$lang} for {$thing->slug}",
                ]);
            }

            // 🖼 Thumb image
            Image::create([
                'imageable_id'   => $thing->id,
                'imageable_type' => ThingToDo::class,
                'image_path'     => 'seed/things/thumb.jpg',
                'role'           => 'thumb',
                'is_primary'     => true,
                'sort_order'     => 0,
            ]);

            // 🖼 Gallery images (3 per thing)
            for ($i = 1; $i <= 3; $i++) {
                Image::create([
                    'imageable_id'   => $thing->id,
                    'imageable_type' => ThingToDo::class,
                    'image_path'     => "seed/things/gallery{$i}.jpg",
                    'role'           => 'gallery',
                    'sort_order'     => $i,
                ]);
            }
        });
    }
}
