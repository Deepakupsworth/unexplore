<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\EventTranslation;
use App\Models\Image;

class EventsSeeder extends Seeder
{
    public function run(): void
    {
        $languages = ['en', 'ar', 'de'];

        Event::factory(25)->create()->each(function ($event) use ($languages) {

            // 🌍 Translations
            foreach ($languages as $lang) {
                EventTranslation::create([
                    'event_id'      => $event->id,
                    'language_code' => $lang,
                    'title'         => strtoupper($lang).' Event '.$event->id,
                    'sub_title'     => "Sub title {$lang}",
                    'url'           => $event->slug.'-'.$lang,
                    'description'   => "Description in {$lang} for event {$event->id}",
                ]);
            }

            // 🖼 Thumb image
            Image::create([
                'imageable_id'   => $event->id,
                'imageable_type' => Event::class,
                'image_path'     => 'seed/events/thumb.jpg',
                'role'           => 'thumb',
                'is_primary'     => true,
            ]);

            // 🖼 Gallery images (3)
            for ($i = 1; $i <= 3; $i++) {
                Image::create([
                    'imageable_id'   => $event->id,
                    'imageable_type' => Event::class,
                    'image_path'     => "seed/events/gallery{$i}.jpg",
                    'role'           => 'gallery',
                    'sort_order'     => $i,
                ]);
            }
        });
    }
}
