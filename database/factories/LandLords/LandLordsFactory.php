<?php

namespace Database\Factories\Landlords;

use App\Models\LandLords\LandLords;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LandLordsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = LandLords::class;
    public function definition()
    {
        return [
            //
            "landlordable_id" => 1,
            "landlordable_type" => "App\Models\User",
            "contact_phone_number_1" => "254714680763",
            "contact_phone_number_2" => "254736748181",
            "account_type" => "DukaVerse",
            "account" => "DVPLT" . rand(10000, 1000000),
        ];
    }
}
