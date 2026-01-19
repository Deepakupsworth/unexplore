<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelFactory extends Factory
{
    protected $model = Hotel::class;

    public function definition(): array
    {
        return [
            'city_id'     => City::inRandomOrder()->value('id'),
            'location'    => $this->faker->address,
            'latitude'    => $this->faker->latitude,
            'longitude'   => $this->faker->longitude,
            'email'       => $this->faker->companyEmail,
            'phone'       => $this->faker->phoneNumber,
            'star_rating' => $this->faker->numberBetween(1, 5),
            'has_meal'    => $this->faker->boolean,
            'status'      => 1,
        ];
    }
}
