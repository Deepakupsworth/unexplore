<?php

namespace Database\Factories;

use App\Models\PackageTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class PackageTranslationFactory extends Factory
{
    protected $model = PackageTranslation::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'sub_title' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(4),
        ];
    }
}
