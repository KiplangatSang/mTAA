<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HousesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $pictures = array(
            " https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/noprofile.png",
            " https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/noprofile.png",
            "https://storage.googleapis.com/dukaverse-e4f47.appspot.com/app/noprofile.png",
        );

        // DB::table('houses')->delete();

        $houses = array(
            array(
                "house_id" => Str::random(5),
                "housable_id" => 1,
                "housable_type" => "App\Models\LandLords\LandLords",
                "caretaker_id" => 1,
                "tenant_id" => 2,
                "plot_location_id" => rand(2, 3),
                "pictures" => json_encode($pictures),
                "price" => rand(2000, 5000),
                "type" => "BedSitter",
                "size" => "Large",
                "floor" => rand(2, 3),
                "available" => rand(0, 1),
                "description" => "The best house around Ongata Rongai",
            ),
            array(
                "house_id" => Str::random(5),
                "housable_id" => 1,
                "housable_type" => "App\Models\LandLords\LandLords",
                "caretaker_id" => 1,
                "tenant_id" => 2,
                "plot_location_id" => rand(2, 3),
                "pictures" => json_encode($pictures),
                "price" => rand(2, 3),
                "type" => "Office",
                "size" => "Large",
                "floor" => rand(2, 3),
                "available" => rand(0, 1),
                "description" => "The best house around Ongata Rongai",
            ),
            array(
                "house_id" => Str::random(5),
                "housable_id" => 1,
                "housable_type" => "App\Models\LandLords\LandLords",
                "caretaker_id" => 1,
                "tenant_id" => 2,
                "plot_location_id" => rand(2, 3),
                "pictures" => json_encode($pictures),
                "price" => rand(2, 3),
                "type" => "Appartment",
                "size" => "Large",
                "floor" => rand(2, 3),
                "available" => rand(0, 1),
                "description" => "The best house around Ongata Rongai",
            ),
            array(
                "house_id" => Str::random(5),
                "housable_id" => 1,
                "housable_type" => "App\Models\LandLords\LandLords",
                "caretaker_id" => 1,
                "tenant_id" => 2,
                "plot_location_id" => rand(2, 3),
                "pictures" => json_encode($pictures),
                "price" => rand(2, 3),
                "type" => "Singles",
                "size" => "Large",
                "floor" => rand(2, 3),
                "available" => rand(0, 1),
                "description" => "The best house around Ongata Rongai",
            ),
            array(
                "house_id" => Str::random(5),
                "housable_id" => 1,
                "housable_type" => "App\Models\LandLords\LandLords",
                "caretaker_id" => 1,
                "tenant_id" => 2,
                "plot_location_id" => rand(2, 3),
                "pictures" => json_encode($pictures),
                "price" => rand(2, 3),
                "type" => "Shop",
                "size" => "Large",
                "floor" => rand(2, 3),
                "available" => rand(0, 1),
                "description" => "The best house around Ongata Rongai",
            ),

        );

        DB::table('houses')->insert($houses);
    }
}
