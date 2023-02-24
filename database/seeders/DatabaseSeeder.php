<?php

namespace Database\Seeders;

use App\Models\BookedHouses;
use App\Models\CaretakerRoles;
use App\Models\Landlords\Caretakers;
use App\Models\LandLords\LandLords;
use App\Models\Payment;
use App\Models\Plots\Houses;
use App\Models\Plots\PlotLocation;
use App\Models\Profile;
use App\Models\Tenants\Tenants;
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
            User::factory(4)
                ->hasProfile(1)
                ->hasHouseBooking(1)
                ->hasTenant(1)
                ->hasLandlord(1)
                ->hasCaretaker(1)
                ->create();
            BookedHouses::factory(4)
                ->hasHouse()
                ->create();
            Payment::factory(4)
                ->hasHouse()
                ->hasTenants()
                ->hasLandlords()
                ->create();
            LandLords::factory(1)
                ->hasTenants(1)
                ->hasCaretakers(1)
                ->hasPlotlocations(1)
                ->hasHouses(1)
                ->hasPayment(1)
                ->hasPaymentReceived(1)
                ->hasProfile(1)
                ->hasHouseProfile(1)
                ->create();
            Tenants::factory(1)
                ->hasLandlords(1)
                ->hasCaretakers(1)
                ->hasPlotlocation(1)
                ->hasHouses(1)
                ->hasPayment(1)
                ->hasPaymentReceived(1)
                ->create();
            Caretakers::factory(1)
                ->hasTenants(1)
                ->hasLandlord(1)
                ->hasHouses(1)
                ->hasPlotlocations(1)
                ->hasProfile(1)
                ->hasHouseProfile(1)
                ->create();
            Profile::factory(5)
                ->hasCaretaker(1)
                ->hasLandlord(1)
                ->create();
            PlotLocation::factory(5)
                ->hasCaretaker(1)
                ->hasTenants(1)
                ->hasHouses(1)
                ->create();
            Houses::factory(10)
                ->hasCaretaker(1)
                ->hasPlotLocation(1)
                ->hasTenant(1)
                ->hasPayments(1)
                ->hasBooked(1)
                ->hasProfile(1)
                ->create();
            CaretakerRoles::factory(4)
                ->create();

            $this->call([
                // AccountSeeder::class,
                // SubscriptionSeeder::class,
                HousesSeeder::class,
                CountriesListSeeder::class,
                KenyaCountiesSeeder::class,

            ]);
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
