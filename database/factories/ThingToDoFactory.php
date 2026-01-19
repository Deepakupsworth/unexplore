<?php

namespace Database\Factories;

use App\Models\ThingToDo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ThingToDoFactory extends Factory
{
    protected $model = ThingToDo::class;

    public function definition()
    {
        $open  = $this->faker->time('H:i:s');
        $close = $this->faker->time('H:i:s');

        return [
            'slug'          => Str::slug($this->faker->unique()->sentence(3)),
            'location'      => $this->faker->streetAddress,
            'city_id'       => \App\Models\City::inRandomOrder()->first()->id,
            'category_id'   => \App\Models\Category::where('type','thing_to_do')->inRandomOrder()->value('id'),
            'opening_time'  => $open,
            'closing_time'  => $close,
            'latitude'      => $this->faker->latitude,
            'longitude'     => $this->faker->longitude,
            'created_at'    => $this->faker->dateTimeBetween('-6 months', 'now'),
            'updated_at'    => now(),
        ];
    }
}
