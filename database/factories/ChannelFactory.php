<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Channel>
 */
class ChannelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'team_id' => function (array $attributes) {
                return User::find($attributes['user_id'])->currentTeam->id;
            },
            'name' => $this->faker->slug,
            'topic' => $this->faker->sentence(10),
            'private' => false,
        ];
    }
}
