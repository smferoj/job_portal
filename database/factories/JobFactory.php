<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
    'title' => fake()->name,
    'user_id' => \App\Models\User::inRandomOrder()->first()->id,
    'job_type_id' => rand(1, 3),
    'category_id' => rand(1, 3),
    'vacancy' => rand(1, 3),
    'location' => fake()->city,
    'experience' => rand(1, 3),
    'description' => fake()->text,
    'benefits' => fake()->paragraph, 
    'responsibility' => fake()->paragraph, 
    'qualifications' => fake()->paragraph, 
    'keywords' => fake()->words(3, true), 
    'salary' => null,
    'company_name' => fake()->company,
    'company_location' => fake()->city,
    'company_website' => fake()->url,
    'created_at' => now(), 
    'updated_at' => now(), 
        ];
    }
}
