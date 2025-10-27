<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ThingToDoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'city_id' => \App\Models\City::inRandomOrder()->first()->id ?? 1,
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id ?? 1,
            'slug' => $this->faker->unique()->slug,
            'image' => $this->faker->imageUrl(800, 600, 'activity'),
            'location' => $this->faker->address,
            // 'about' => $this->faker->paragraph(4),
        ];
    }
}

