<?php

namespace Database\Factories;

use App\Enums\StudyStatus;
use App\Models\Study;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class StudyFactory extends Factory
{
    protected $model = Study::class;

    public function definition()
    {
        $title = fake()->company();

        return [
            'title' => $title,
            'related_title' => Str::of($title)->limit(20),
            'slug' => Str::of($title)->slug(),
            'html_title' => fake()->sentence(),
            'meta_desc' => fake()->paragraph(),
            'brief' => fake()->text(),
            'approach' => fake()->text(),
            'result' => fake()->text(),
            'quote' => fake()->text(),
            'client' => fake()->name().', '.fake()->jobTitle(),
            'homepage_text' => fake()->text(120),
            'study_list_text' => fake()->text(120),
            //            'image_hero' => fake()->word(),
            //            'image_half_1' => fake()->word(),
            //            'image_half_2' => fake()->word(),
            //            'image_full_top' => fake()->word(),
            //            'image_full_bottom' => fake()->word(),
            //            'image_hero' => '',
            //            'image_half_1' => '',
            //            'image_half_2' => '',
            //            'image_full_top' => '',
            //            'image_full_bottom' => '',
            'url' => fake()->url(),
            //            'categories' => fake()->randomElements(['1', '2', '3', '4', '5', '6', '7'], null),
            //            'user_id' => User::inRandomOrder()->first(),
            'related_1' => '2',
            'related_2' => '3',
            'related_3' => '4',
            'status' => StudyStatus::PUBLISHED, //fake()->randomElement(StudyStatus::class),
            'published_at' => Carbon::now()->subDay(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function draft(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => StudyStatus::DRAFT,
            'published_at' => null,
        ]);
    }

    public function scheduled(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => StudyStatus::SCHEDULED,
            'published_at' => Carbon::now()->addMonth(),
        ]);
    }

    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => StudyStatus::UNPUBLISHED,
            'published_at' => Carbon::now()->subDay(),
        ]);
    }
}
