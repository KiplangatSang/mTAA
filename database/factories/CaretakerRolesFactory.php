<?php

namespace Database\Factories;

use App\Models\CaretakerRoles;
use App\Models\Landlords\Caretakers;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CaretakerRolesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     protected $model= CaretakerRoles::class;
    public function definition()
    {
        return [
            //
            'roleable_id' => 1,
            'roleable_type' => "App\Models\User",
            'name' => $this->faker->jobTitle(),
            'description' => $this->faker->paragraph(),
            'status' => $this->faker->boolean(),
        ];
    }
}
