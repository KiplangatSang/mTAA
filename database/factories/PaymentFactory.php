<?php

namespace Database\Factories;

use App\Models\LandLords\LandLords;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;


class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Payment::class;
    public function definition()
    {
        return [
            //
            'payable_id' => 1,
            'payable_type' =>"App\Models\User",
            'house_id' => 1,
            'tenant_id' => 1,
            'landlord_id' => 1,
            "gateway" => "DukaVerse",
            "confirmation" => Str::random(10),
            "reference" => Str::random(10),
            'sender' => $this->faker->name(),
            'receiver' => $this->faker->name(),
            'amount' => rand(1, 10),
            'purpose' => "House Payment",
            'status' => true,
            'on_hold'=> true,
            'sender_account' => "DVR" . rand(10000, 1000000),
            'receiver_account' => "DVPLT" . rand(10000, 1000000),
        ];
    }
}
