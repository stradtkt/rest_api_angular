<?php

namespace Database\Factories;

use App\Models\Friendship;
use Illuminate\Database\Eloquent\Factories\Factory;

class FriendshipFactory extends Factory
{
    protected $model = Friendship::class;

    public function definition(): array
    {
        return [
            'sender_id' => $this->faker->word(),
        ];
    }
}
