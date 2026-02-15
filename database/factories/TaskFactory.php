<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\TaskStatus;
use App\Enums\TaskPriority;
use App\Enums\TaskPosition;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition(): array
    {
        $userIds = User::pluck('id')->toArray();

        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
            'status' => $this->faker->randomElement(TaskStatus::values()),
            'end_date' => $this->faker->optional()->date(),
            'end_date_updated' => $this->faker->optional()->dateTime(),
            'priority' => $this->faker->randomElement(TaskPriority::values()),
            'position' => $this->faker->randomElement(TaskPosition::values()),
            'user_id' => $this->faker->optional()->randomElement($userIds),
            'created_by' => $this->faker->randomElement($userIds),
            'completed_at' => $this->faker->optional()->dateTime(),
        ];
    }

    public function completed()
    {
        return $this->state(fn(array $attributes) => [
            'status' => TaskStatus::Done->value,
            'completed_at' => now(),
        ]);
    }
}
