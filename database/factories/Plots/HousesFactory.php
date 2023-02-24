<?php

namespace Database\Factories\Plots;

use App\Models\LandLords\LandLords;
use App\Models\Plots\Houses;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HousesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Houses::class;
    public function definition()
    {
        $pictures = array(
            " https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/noprofile.png",
            " https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/noprofile.png",
            "https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/noprofile.png",
        );
        $houseImages['insideimages'] = $pictures;
        $houseImages['outsideimages'] = $pictures;

        return [
            //
            "house_id" => Str::random(5),
            "houseable_id" => 1,
            "houseable_type" => "App\Models\LandLords\LandLords",
            "caretaker_id" => 1,
            "tenant_id" => 2,
            "plot_location_id" => rand(2, 3),
            "pictures" => json_encode($houseImages),
            "price" => rand(2, 3),
            "type" => "BedSitter",
            "size" => "Large",
            "floor" => rand(2, 3),
            "available" => rand(0, 1),
            "description" => "The best house around Ongata Rongai",
        ];
    }
}
