<?php

namespace Database\Seeders;

use App\Models\BookedHouses;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        if (env('APP_DEBUG')) {
           // User::factory(1)->create();
            BookedHouses::factory(4)->create();
            // $this->call([
            //     // AccountSeeder::class,
            //     // SubscriptionSeeder::class,
            //     HousesSeeder::class,
            //     CountriesListSeeder::class,
            //     KenyaCountiesSeeder::class,

            // ]);
        } else {
            User::factory(10)->create();
            $this->call([
                // AccountSeeder::class,
                // SubscriptionSeeder::class,
                CountriesListSeeder::class,
                KenyaCountiesSeeder::class,
            ]);
        }
    }
}
