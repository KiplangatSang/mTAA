<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $number = 0;
        $email = null;
        if ($number == 0)
            $email = "admin@gmail.com";
        else if ($number == 1)
            $email = "tenant@gmail.com";
        else if ($number == 2)
            $email = "landlord@gmail.com";
        else if ($number == 3)
            $email = "caretaker@gmail.com";
        else
            $email = $this->faker->email();
        return [
            //'username' => env('APP_NAME'),
            'username' =>  $this->faker->name(),
            //for admin uncomment Mtaa@gmail.com and comment  faker
            //  'email' => "Mtaa@gmail.com",
            'email' => $email,
            'email_verified_at' => now(),
            // 'password' =>  Hash::make("Dukaverse!^!^)"),
            'password' =>  Hash::make("password"),
            'userpin' => 7765,
            'phoneno' => "254714680763",
            'terms_and_conditions' => 'Accepted',
            //   'is_admin' => true,
            'is_admin' => false,
            // 'role' => 0,
            'role' => $number++,
            'is_suspended' => false,
            'remember_token' => Str::random(10),
            'api_token' => Str::random(60),
            'month' => date('m'),
            'year' => date('Y'),
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
