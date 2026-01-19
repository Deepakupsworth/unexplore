<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{
    Package,
    City
};

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $languages = ['en', 'de', 'fr'];

        Package::factory()
            ->count(5)
            ->create()
            ->each(function (Package $package) use ($languages) {

                /* -----------------------------
                 | Images (thumb + gallery)
                 |-----------------------------*/
                if (! $package->image('thumb')->exists()) {
                    $package->images()->create([
                        'type' => 'thumb',
                        'path' => 'packages/thumb.jpg',
                        'alt'  => 'Package thumbnail',
                    ]);
                }

                if ($package->images()->where('type', 'gallery')->count() === 0) {
                    foreach (range(1, 3) as $i) {
                        $package->images()->create([
                            'type' => 'gallery',
                            'path' => "packages/gallery{$i}.jpg",
                            'alt'  => "Package gallery image {$i}",
                        ]);
                    }
                }

                /* -----------------------------
                 | Translations
                 |-----------------------------*/
                foreach ($languages as $lang) {
                    $package->translations()->firstOrCreate(
                        ['language_code' => $lang],
                        [
                            'title' => "Sample Package ({$lang})",
                            'sub_title' => "Best experience ({$lang})",
                            'description' => "Long description for {$lang}",
                        ]
                    );
                }

                /* -----------------------------
                 | Availability
                 |-----------------------------*/
                $package->availabilities()->firstOrCreate([
                    'available_from' => now()->addDays(10),
                    'available_to' => now()->addMonths(6),
                ]);

                /* -----------------------------
                 | Cities
                 |-----------------------------*/
                $cities = City::inRandomOrder()->take(2)->get();
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

                /* -----------------------------
                 | Days
                 |-----------------------------*/
                $dayNumber = 1;
                foreach ($cities as $city) {
                    $day = $package->days()->create([
                        'day_number' => $dayNumber++,
                        'city_id' => $city->id,
                    ]);

                    // Example day items
                    $day->items()->createMany([
                        [
                            'item_type' => 'transport',
                            'item_id' => 1,
                            'sort_order' => 1,
                        ],
                        [
                            'item_type' => 'hotel',
                            'item_id' => 1,
                            'sort_order' => 2,
                        ],
                        [
                            'item_type' => 'event',
                            'item_id' => 1,
                            'sort_order' => 3,
                        ],
                    ]);
                }

                /* -----------------------------
                 | Price
                 |-----------------------------*/
                $package->price()->firstOrCreate([
                    'currency' => 'INR',
                    'original_price' => 25000,
                    'discount_price' => 22000,
                    'per_person_price' => 11000,
                ]);

                /* -----------------------------
                 | Extra Person Price
                 |-----------------------------*/
                foreach ([3, 4, 5] as $person) {
                    $package->priceIncreases()->firstOrCreate(
                        ['person_number' => $person],
                        ['additional_price' => 3000]
                    );
                }

                /* -----------------------------
                 | Child Prices
                 |-----------------------------*/
                $package->childPrices()->firstOrCreate([
                    'min_age' => 3,
                    'max_age' => 10,
                    'price_type' => 'percentage',
                    'price_value' => 50,
                ]);
            });
    }
}
