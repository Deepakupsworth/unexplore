<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('+1 days', '+1 month');
        $end = (clone $start)->modify('+'.rand(1,5).' days');

        return [
            'city_id' => \App\Models\City::inRandomOrder()->first()->id ?? 1,
            'slug' => $this->faker->unique()->slug,
            'image' => $this->faker->imageUrl(800, 600, 'event'),
            'start_date' => $start,
            'end_date' => $end,
            'opening_days' => implode(',', $this->faker->randomElements(
                ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'], rand(3,7)
            )),
            'opening_time' => '10:00:00',
            'closing_time' => '22:00:00',
        ];
    }
}

