<?php

namespace Database\Factories\Landlords;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CaretakersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            "caretakerable_id" => 1,
            "caretakerable_type" => "App\Models\User",
            "user_id" => "4",
            "landlord_id" => 3,
            "role" => 3,
            "contact_phone_number_1" => 254714680763,
            "contact_phone_number_2" => 254714680763,
            "account_type" => "DukaVerse",
            "account" => "DVU" . rand(10000, 100000),

        ];
    }
}
