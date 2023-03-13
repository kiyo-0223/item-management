<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

class ItemFactory extends Factory
{
    protected $model = Item::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->realText(10),
            'type_id' => rand(1, 6),
            'detail' => $this->faker->realText(20),
            'quantity' => rand(1, 99),
            'code' => rand(1111111, 9999999),
            'user_id' => 1,
        ];
    }
}
