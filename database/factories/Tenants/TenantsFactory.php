<?php

namespace Database\Factories\Tenants;

use Illuminate\Database\Eloquent\Factories\Factory;

class TenantsFactory extends Factory
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
            "tenantable_id" => 2,
            "tenantable_type" => "App\Models\User",
            "account_type" => "DukaVerse",
            "account" => "DVPLT" . rand(1000, 100000),
        ];
    }
}
