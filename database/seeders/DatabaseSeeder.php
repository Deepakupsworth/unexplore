<?php

// namespace Database\Seeders;

// use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// use Illuminate\Database\Seeder;

// class DatabaseSeeder extends Seeder
// {
//     use WithoutModelEvents;

//     /**
//      * Seed the application's database.
//      */
//     public function run(): void
//     {
//         // User::factory(10)->create();

//         User::factory()->create([
//             'name' => 'Test User',
//             'email' => 'test@example.com',
//         ]);
//     }
// }

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Language, City, CityTranslation, Category,
    ThingToDo, ThingToDoTranslation, Event, EventTranslation
};

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Languages
        $languages = Language::insertOrIgnore([
            ['code' => 'en', 'name' => 'English', 'created_at' => now(), 'updated_at' => now()],
            ['code' => 'ar', 'name' => 'Arabic', 'created_at' => now(), 'updated_at' => now()],
        ]);

        $languageIds = \App\Models\Language::pluck('id')->toArray();

        // Cities
        City::factory(5)
            ->create()
            ->each(function ($city) use ($languageIds) {
                foreach ($languageIds as $langId) {
                    CityTranslation::factory()->create([
                        'city_id' => $city->id,
                        'language_id' => $langId,
                    ]);
                }
            });

        // Categories
        Category::factory(6)->create();

        // Things To Do (with translations)
        ThingToDo::factory(20)
            ->create()
            ->each(function ($thing) use ($languageIds) {
                foreach ($languageIds as $langId) {
                    ThingToDoTranslation::factory()->create([
                        'thing_id' => $thing->id,
                        'language_id' => $langId,
                    ]);
                }
            });

        // Events (with translations)
        Event::factory(15)
            ->create()
            ->each(function ($event) use ($languageIds) {
                foreach ($languageIds as $langId) {
                    EventTranslation::factory()->create([
                        'event_id' => $event->id,
                        'language_id' => $langId,
                    ]);
                }
            });
    }
}

