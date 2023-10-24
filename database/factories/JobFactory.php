<?php

namespace Database\Factories;

use App\Models\Job;
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
            'title' => fake()->jobTitle,
            'description' => fake()->paragraphs(3, true),
            'location' => fake()->city,
            'category' => fake()->randomElement(Job::$category),
            'experience' => fake()->randomElement(Job::$experience),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Job $job) {
            $experience = $job->experience;

            if ($experience === 'junior') {
                $job->salary = fake()->numberBetween(25_000, 50_000);
            } elseif ($experience === 'intermediate') {
                $job->salary = fake()->numberBetween(50_000, 100_000);
            } elseif ($experience === 'senior') {
                $job->salary = fake()->numberBetween(100_000, 200_000);
            }
        });
    }

    public function junior()
    {
        return $this->state(function (array $attributes) {
            return [
                'experience' => 'junior',
            ];
        });
    }

    public function intermediate()
    {
        return $this->state(function (array $attributes) {
            return [
                'experience' => 'intermediate',
            ];
        });
    }

    public function senior()
    {
        return $this->state(function (array $attributes) {
            return [
                'experience' => 'senior',
            ];
        });
    }
}
