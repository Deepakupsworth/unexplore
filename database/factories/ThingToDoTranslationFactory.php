<?php

namespace Database\Factories;

use App\Models\ThingToDoTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThingTranslationFactory extends Factory
{
    protected $model = ThingToDoTranslation::class;

    public function definition()
    {
        return [
            'name'  => $this->faker->sentence(3),
            'about' => $this->faker->paragraph(4),
        ];
    }
}
