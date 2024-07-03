<?php

namespace Database\Factories;

use App\Models\Favorites;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoritesFactory extends Factory
{

    protected $model = Favorites::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => $this->faker->favorites,
        ];
    }
}
