<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;


class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            // 'user_id' => User::factory()->create(),
            // 'category_id' => Category::factory()->create(),
            'title' => $this->faker->sentence(),
            'excerpt' => collect($this->faker->paragraphs(2))->map(function ($item) {
                return "<p>{$item}</p>";
            })->implode(''),
            'slug' => $this->faker->slug(),
            'body' => collect($this->faker->paragraphs(7))->map(function ($item) {
                return "<p>{$item}</p>";
            })->implode(''),
        ];
    }
}
