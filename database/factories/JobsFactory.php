<?php

namespace Database\Factories;

use App\Models\Clients;
use App\Models\Jobs;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class JobsFactory extends Factory
{
    protected $model = Jobs::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'status' => $this->faker->word(),
            'start_date' => Carbon::now(),
            'due_date' => Carbon::now(),
            'budget' => $this->faker->randomFloat(),
            'amount_spent' => $this->faker->randomFloat(),
            'priority' => $this->faker->word(),
            'location' => $this->faker->word(),
            'description' => $this->faker->text(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
            'client_id' => Clients::factory(),
        ];
    }
}
