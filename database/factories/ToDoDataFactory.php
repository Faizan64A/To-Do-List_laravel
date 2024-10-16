<?php

namespace Database\Factories;

use App\Models\ToDoData;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ToDoData>
 */
class ToDoDataFactory extends Factory
{
    protected $model = ToDoData::class;

    public function definition()
    {
        return [
            'title' => $this->faker->sentence(),
            'description' => $this->faker->text(50),
            'status' => $this->faker->boolean(),
            'user_id' => 203,
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'), 
        ];
    }
}
