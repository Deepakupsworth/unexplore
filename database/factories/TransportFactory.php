<?php

namespace Database\Factories;

use App\Models\Transport;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransportFactory extends Factory
{
    protected $model = Transport::class;

    public function definition(): array
    {
        return [
            'city_id' => City::inRandomOrder()->value('id'),
            'type' => 'taxi',                // ✅ ONLY taxi
            'contact_number' => $this->faker->optional()->phoneNumber(),
            'capacity' => 4,                 // taxi = 4 pax
            'status' => true,
        ];
    }
}
