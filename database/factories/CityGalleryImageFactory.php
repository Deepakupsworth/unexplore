<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CityGalleryImageFactory extends Factory
{
    public function definition(): array
    {
        return [
            'image_url' => $this->faker->imageUrl(800, 600, 'gallery'),
        ];
    }
}

