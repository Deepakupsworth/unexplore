<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ThingGalleryImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'image_url' => $this->faker->imageUrl(800, 600, 'gallery'),
        ];
    }
}
