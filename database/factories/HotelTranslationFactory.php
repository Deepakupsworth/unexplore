<?php

namespace Database\Factories;

use App\Models\HotelTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class HotelTranslationFactory extends Factory
{
    protected $model = HotelTranslation::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->company . ' Hotel',
            'description' => $this->faker->paragraph(4),
        ];
    }
}
