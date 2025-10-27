<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->languageCode, // e.g. 'en', 'ar'
            'name' => ucfirst($this->faker->unique()->languageCode),
        ];
    }
}

