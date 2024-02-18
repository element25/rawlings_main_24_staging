<?php

namespace Database\Factories;

use App\Models\StudyCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class StudyCategoryFactory extends Factory
{
    protected $model = StudyCategory::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3),
            'short_name' => faker()->words(2),
            'colour' => $this->faker->colorName(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
