<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CityFactory extends Factory
{
    protected $model = City::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->city();

        return [
            'slug' => Str::slug($name),
            'thumb_image' => null, // legacy-safe
            'video_url' => null,
            'country_id' => Country::inRandomOrder()->value('id'),
            'category_id' => null,
        ];
    }
}
