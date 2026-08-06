<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
    public function definition(): array
    {
        $title = fake()->sentence(5);

        return [
            'title' => $title,
            'content' => fake()->paragraphs(3, true),
            'user_id' => User::inRandomOrder()->first()?->id ?? User::factory(),
            'image' => 'default.jpg',
            'slug' => Str::slug($title) . '-' . fake()->unique()->numberBetween(100, 999),
        ];
    }
}