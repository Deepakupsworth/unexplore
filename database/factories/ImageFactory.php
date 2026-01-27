<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition(): array
    {
        return [
            'image_path'  => 'hotels/' . $this->faker->uuid . '.jpg',
            'role'        => 'gallery',
            'is_primary'  => false,
            'sort_order'  => 0,
            'language_code' => null,
        ];
    }
}
