<?php

namespace Database\Factories;

use App\Models\BookedHouses;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookedHousesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = BookedHouses::class;
    public function definition()
    {
        return [
            //
            "bookable_id" => 1,
            "bookable_type" => "App\Models\User",
            "house_id" => rand(1,8)
        ];
    }
}
