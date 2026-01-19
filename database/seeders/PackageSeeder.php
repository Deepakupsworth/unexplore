<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

use App\Models\{
    Package,
    City,
    Hotel,
    Transport,
    Event
};

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $start = Carbon::createFromTime(
            rand(6, 20),          // hour: 06–20
            collect([0, 15, 30, 45])->random() // minutes
        );
        
        $end = (clone $start)->addMinutes(rand(30, 180)); // 30 min – 3 hours

        $languages = ['en', 'de', 'fr'];

        // ✅ Create ONLY if slug not exists (legacy safe)
        $package = Package::firstOrCreate(
            ['slug' => 'sample-legacy-package'],
            [
                'status' => 'active',
                'package_type' => 'fixed',
                'category_id' => 1,
                'duration_days' => 5,
                'duration_nights' => 4,
                'base_persons' => 2,
                'max_persons' => 8,
            ]
        );

        /* ----------------------------------
         | TRANSLATIONS
         |-----------------------------------*/
        foreach ($languages as $lang) {
            $package->translations()->firstOrCreate(
                ['language_code' => $lang],
                [
                    'title' => "Legacy Package ({$lang})",
                    'sub_title' => "Experience {$lang}",
                    'description' => "Legacy package description in {$lang}",
                ]
            );
        }

        /* ----------------------------------
         | AVAILABILITY
         |-----------------------------------*/
        $package->availabilities()->firstOrCreate([
            'available_from' => now()->addDays(7),
            'available_to' => now()->addMonths(12),
        ]);

        /* ----------------------------------
         | CITIES
         |-----------------------------------*/
        $cities = City::limit(2)->get();
        $sort = 1;

        foreach ($cities as $city) {
            $package->cities()->firstOrCreate(
                ['city_id' => $city->id],
                [
                    'nights' => 2,
                    'sort_order' => $sort++,
                ]
            );
        }

        /* ----------------------------------
         | DAYS & DAY ITEMS (TYPE-WISE)
         |-----------------------------------*/
        $dayNumber = 1;

        foreach ($cities as $city) {

            $day = $package->days()->firstOrCreate([
                'day_number' => $dayNumber,
                'city_id' => $city->id,
            ]);

            // HOTEL
            if ($hotel = Hotel::where('city_id', $city->id)->first()) {
                $day->items()->firstOrCreate([
                    'item_type' => 'hotel',
                    'item_id' => $hotel->id,
                    'sort_order' => 1,
                ]);
            }

            // TRANSPORT
            if ($transport = Transport::where('city_id', $city->id)->first()) {
                $day->items()->firstOrCreate([
                    'item_type' => 'transport',
                    'item_id' => $transport->id,
                    'start_time' => $start->format('H:i'),
                    'end_time'   => $end->format('H:i'),
                    'sort_order' => 2,
                ]);
            }

            // EVENT
            if ($event = Event::where('city_id', $city->id)->first()) {
                $day->items()->firstOrCreate([
                    'item_type' => 'event',
                    'item_id' => $event->id,
                    'start_time' => $start->format('H:i'),
                    'end_time'   => $end->format('H:i'),
                    'sort_order' => 3,
                ]);
            }

            // TODO / THING TO DO (STATIC ID SAFE)
            $day->items()->firstOrCreate([
                'item_type' => 'todo',
                'item_id' => 0,
                'sort_order' => 4,
                'start_time' => $start->format('H:i'),
                'end_time'   => $end->format('H:i'),
            ]);

            $dayNumber++;
        }

        /* ----------------------------------
         | PACKAGE INFO + TRANSLATIONS
         |-----------------------------------*/
        foreach (['cancellation', 'visa', 'season'] as $type) {

            $info = $package->infos()->firstOrCreate([
                'type' => $type,
            ]);

            foreach ($languages as $lang) {
                $info->translations()->firstOrCreate(
                    ['language_code' => $lang],
                    [
                        'title' => ucfirst($type),
                        'content' => "Legacy {$type} info ({$lang})",
                    ]
                );
            }
        }

        /* ----------------------------------
         | PRICES
         |-----------------------------------*/
        $package->price()->firstOrCreate([
            'currency' => 'INR',
            'original_price' => 30000,
            'discount_price' => 27000,
            'per_person_price' => 13500,
        ]);

        /* ----------------------------------
         | EXTRA PERSON PRICE
         |-----------------------------------*/
        foreach ([3, 4, 5] as $person) {
            $package->priceIncreasePersons()->firstOrCreate(
                ['person_number' => $person],
                ['additional_price' => 3500]
            );
        }

        /* ----------------------------------
         | CHILD PRICES
         |-----------------------------------*/
        $package->childPrices()->firstOrCreate([
            'min_age' => 3,
            'max_age' => 10,
            'price_type' => 'percentage',
            'price_value' => 50,
        ]);
    }
}
