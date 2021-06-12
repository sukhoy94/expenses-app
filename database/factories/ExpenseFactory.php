<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Expense::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'amount' => $this->faker->randomElement(range(1,15)),
            'title' => $this->faker->randomElement(['magaz', 'jakdojade', 'bolt', 'allegro',]),
            'category_id' => $this->faker->randomElement([1,2,3,4,5,6,7,]),
        ];
    }
}
