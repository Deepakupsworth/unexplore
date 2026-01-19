<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transport;

class TransportSeeder extends Seeder
{
    public function run(): void
    {
        $labels = [
            'en' => 'Taxi',
            'de' => 'Taxi',
            'fr' => 'Taxi',
        ];

        Transport::factory()
            ->count(10)
            ->create()
            ->each(function ($transport) use ($labels) {

                // ✅ ADD image ONLY if transport has no thumb yet
                if (! $transport->image()->exists()) {
                    $transport->image()->create([
                        'type' => 'thumb',
                        'path' => 'transports/taxi.png',
                        'alt'  => 'Taxi transport',
                    ]);
                }

                foreach ($labels as $lang => $label) {

                    $transport->translations()->create([
                        'language_code' => $lang,
                        'name' => $label,
                        'description' => "Standard {$label} service",
                    ]);
                }
            });
    }
}
