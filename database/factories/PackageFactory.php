<?php

namespace Database\Factories;

use App\Models\Package;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PackageFactory extends Factory
{
    protected $model = Package::class;

    public function definition(): array
    {
        return [
            'slug' => Str::slug($this->faker->unique()->sentence(3)),
            'status' => 'active',
            'package_type' => 'fixed',
            'category_id' => Category::where('type','package')->inRandomOrder()->value('id'),
            'duration_days' => 5,
            'duration_nights' => 4,
            'base_persons' => 2,
            'max_persons' => 10,
        ];
    }
}
