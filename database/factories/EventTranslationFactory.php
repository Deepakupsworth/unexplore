<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventTranslationFactory extends Factory
{
    public function definition(): array
    {
        return [
            'language_id' => \App\Models\Language::inRandomOrder()->first()->id ?? 1,
            'name' => $this->faker->sentence(4),
            'about' => $this->faker->paragraph(5),
        ];
    }
}
