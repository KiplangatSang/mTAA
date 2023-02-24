<?php

namespace Database\Factories\Plots;

use App\Models\LandLords\LandLords;
use App\Models\Plots\PlotLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlotLocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = PlotLocation::class;
    public function definition()
    {
        $types = [
            'Houses',
            'Appartments',
            'Offices'
        ];
        return [

            "plot_locationable_id" => 3,
            "plot_locationable_type" => "App\Models\LandLords\LandLords",
            "landlord_id" => 3,
            "caretaker_id" => 4,
            "name" => $this->faker->name(),
            "location" => $this->faker->city(),
            "gate" => $this->faker->colorName(),
            "no_of_houses" => rand(1, 3),
            "house_types" => json_encode( $types),
            "town" => $this->faker->city(),
            "city" => $this->faker->city(),
            "constituency" => $this->faker->city,
            "county" => $this->faker->city,
            "country" => $this->faker->country(),
            "account_type" => "DukaVerse",
            "account" => "DVPLT" . rand(10000, 7000000),
        ];
    }
}
