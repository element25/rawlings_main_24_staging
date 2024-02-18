<?php

namespace Database\Factories;

use App\Enums\NewsStatus;
use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class NewsFactory extends Factory
{
    protected $model = News::class;

    public function definition(): array
    {
        $title = $this->faker->sentence();

        return [
            'title' => $title,
            'summary' => $this->faker->paragraph(),
            //            'content' => $this->faker->paragraph(),
            'slug' => Str::of($title)->slug(),
            'html_title' => $this->faker->sentence(),
            'meta_desc' => $this->faker->paragraph(),
            'related_1' => 1,
            'related_2' => 3,
            'status' => NewsStatus::PUBLISHED,
            'published_at' => Carbon::now()->subDay(),
            'version' => 2024,
            'user_id' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => NewsStatus::DRAFT,
            'published_at' => null,
        ]);
    }

    public function scheduled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => NewsStatus::SCHEDULED,
            'published_at' => Carbon::now()->addMonth(),
        ]);
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => NewsStatus::UNPUBLISHED,
            'published_at' => Carbon::now()->subDay(),
        ]);
    }
}
