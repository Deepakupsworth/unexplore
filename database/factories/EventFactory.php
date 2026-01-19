<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-2 months', '+2 months');
        $end   = (clone $start)->modify('+'.rand(1,5).' days');

        return [
            'slug'          => Str::slug($this->faker->unique()->sentence(3)),
            'start_date'    => $start->format('Y-m-d'),
            'end_date'      => $end->format('Y-m-d'),
            'opening_days'  => $this->faker->randomElement(['Mon–Fri', 'Fri–Sun', 'All Days']),
            'opening_time'  => $this->faker->time('H:i:s'),
            'closing_time'  => $this->faker->time('H:i:s'),
            'city_id'       => \App\Models\City::inRandomOrder()->value('id'),
            'category_id'   => \App\Models\Category::where('type','event')->inRandomOrder()->value('id'),
            'capacity'      => rand(50, 500),
            'status'        => $this->faker->boolean(85),
            'location'      => $this->faker->streetAddress,
            'latitude'      => $this->faker->latitude,
            'longitude'     => $this->faker->longitude,
            'video_url'     => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
            'url'           => $this->faker->url,
            'created_at'    => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at'    => now(),
        ];
    }
}
