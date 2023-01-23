<?php

namespace Database\Factories;

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
        return [
            // 'name' => $this->faker->name(),
            // 'email' => $this->faker->unique()->safeEmail(),
            // 'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'remember_token' => Str::random(10),

            'username' => env('APP_NAME'),
            'email' => "dukaverse@gmail.com",
            'email_verified_at' => now(),
            'password' =>  Hash::make("Dukaverse!^!^)"),
            'userpin' => 7765,
            'phoneno' => "254714680763",
            'terms_and_conditions' => 'Accepted',
            'is_owner' => false,
            'is_employee' => false,
            'is_admin' => true,
            'role' => 0,
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