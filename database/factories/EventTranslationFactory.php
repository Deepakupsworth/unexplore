<?php

namespace Database\Factories;

use App\Models\EventTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventTranslationFactory extends Factory
{
    protected $model = EventTranslation::class;

    public function definition(): array
    {
        return [
            'title'       => $this->faker->sentence(3),
            'sub_title'   => $this->faker->sentence(5),
            'url'         => $this->faker->slug,
            'description' => $this->faker->paragraph(4),
        ];
    }
}
