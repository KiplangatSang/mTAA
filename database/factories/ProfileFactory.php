<?php

namespace Database\Factories;

use App\Models\Profile;
use App\Models\User;
use App\Repositories\AppRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Profile::class;



    public function definition()
    {
        $apprepo = new AppRepository();
        $no_profile = $apprepo->getBaseImages()['noprofile'];
        return [
            //
            "profileable_id" => 1,
            "profileable_type" => "App\Models\User",
            "user_id" => 1,
            "landlord_id" => 3,
            "caretaker_id" => 4,
            "profile_image" => $no_profile,
        ];
    }
}
