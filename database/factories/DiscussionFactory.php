<?php

namespace Database\Factories;

use App\Models\Discussion;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discussion>
 */
class DiscussionFactory extends Factory
{
    public function configure(): static
    {
        return $this->afterCreating(function (Discussion $discussion) {
            $course = $discussion->loadMissing([
                'creator'
            ])->course;

            $initialPost =  Post::factory()
                ->for($course->creator, 'user')
                ->for($discussion, 'discussion')
                ->create();

            $discussion->initialPost()->associate($initialPost)->save();
        });
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
        ];
    }
}
