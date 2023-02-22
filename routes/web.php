<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Houses\HouseBookingController;
use App\Http\Controllers\Landlord\HouseBookingController as LandlordHouseBookingController;
use App\Http\Controllers\Landlord\HouseController;
use App\Http\Controllers\Landlord\PlotLocationController;
use App\Http\Controllers\Landlord\PlotSessionController;
use App\Http\Controllers\WelcomeController;
use App\Models\Plots\Houses;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $houses = Houses::simplePaginate(4);
    $homedata['houses'] = $houses;
    return view('welcome', compact("homedata"));
})->name('welcome');

Route::get('/help', function () {
    return view('help');
})->name('help');

Auth::routes();

//home route
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/search-houses', [WelcomeController::class, 'search'])->name('search-houses');

Route::get('/houses', function () {
    return redirect(route('home'));
})->name('houses');
//houses group
Route::prefix('/houses')->name('houses.')->group(
    function () {
        //session plot

        Route::get('/book/show/{id}', [HouseBookingController::class, 'show'])->name('book');
        Route::get('/book/pay/{id}', [HouseBookingController::class, 'pay'])->name('book.pay');
        Route::post('/book/store', [HouseBookingController::class, 'store'])->name('book.store');
        Route::get('/book/index', [HouseBookingController::class, 'index'])->name('booked');
        Route::get('/book/destroy/{id}', [HouseBookingController::class, 'destroy'])->name('booked.delete');

        //houses pictures
        Route::get('/pictures/show', [HouseBookingController::class, 'show'])->name('pictures.show');
        Route::post('/pictures/inside/store', [HouseController::class, 'uploadInsideImages'])->name('images.inside.store');
        Route::post('/pictures/outside/store', [HouseController::class, 'uploadOutsideImages'])->name('images.outside.store');
    }
);


//session group
Route::prefix('/session')->name('session.')->middleware(['landlord',])->group(
    function () {
        //session plot
        Route::get('/plot', [PlotSessionController::class, 'index'])->name('plotlocation.index');
        Route::post('/plot/store', [PlotSessionController::class, 'store'])->name('plotlocation.store');
    }
);


Route::get('/plots/create', [PlotLocationController::class, 'create'])->name('plotlocation.create');
//landlords group
Route::prefix('/landlord')->name('landlord.')->middleware(['landlord',])->group(
    function () {
        Route::get('/home', [HomeController::class, 'landlord'])->name('home');
        // plot location
        Route::get('/plots/index', [PlotLocationController::class, 'index'])->name('plotlocation');
        Route::get('/plots/create', [PlotLocationController::class, 'create'])->name('plotlocation.create');
        Route::post('/plots/store', [PlotLocationController::class, 'store'])->name('plotlocation.store');
        Route::get('/plots/show/{id}', [PlotLocationController::class, 'show'])->name('plotlocation.show');
        Route::get('/plots/edit/{id}', [PlotLocationController::class, 'edit'])->name('plotlocation.edit');
        Route::post('/plots/update/{id}', [PlotLocationController::class, 'update'])->name('plotlocation.update');

        Route::middleware(['plotregister', 'plotsession'])->group(function () {
            //houses
            Route::get('/houses/index', [HouseController::class, 'index'])->name('houses');
            Route::get('/houses/create', [HouseController::class, 'create'])->name('houses.create');
            Route::get('/houses/show/{id}', [HouseController::class, 'show'])->name('houses.show');
            Route::get('/houses/delete/{id}', [HouseController::class, 'destroy'])->name('houses.delete');
            Route::post('/houses/store', [HouseController::class, 'store'])->name('houses.store');

            Route::post('/houses/upload/outsideimages', [HouseController::class, 'uploadOutsideImages'])->name('images.upload.outside');
            Route::post('/houses/upload/insideimages', [HouseController::class, 'uploadInsideImages'])->name('images.upload.inside');

            Route::get('/houses/delete/{id}', [HouseController::class, 'destroy'])->name('houses.delete');

            //bookings
            Route::get('/houses/boookings/index', [LandlordHouseBookingController::class, 'index'])->name('houses.booked.index');
            Route::get('/houses/boookings/{id}', [LandlordHouseBookingController::class, 'show'])->name('houses.booked.show');
            Route::post('/houses/payment/refund/{house_id}', [LandlordHouseBookingController::class, 'refund'])->name('payment.reverse');
            Route::post('/houses/tenant/store/{house_id}/{tenant_id}', [LandlordHouseBookingController::class, 'tenant_accept'])->name('houses.tenant.store');
            Route::get('/houses/tenant/request_payment/{house_id}/{tenant_id}', [LandlordHouseBookingController::class, 'tenant_requet_payment'])->name('houses.tenant.requet-payment');



            Route::get('/houses/types', function () {
                return view("landlord.houses.types.index");
            })->name('houses.types');

            //caretakers
            Route::get('/caretakers/index', function () {
                return "/landlord/caretakers/index";
            })->name('caretakers');
            Route::get('/caretakers/create', function () {
                return "landlord.caretakers.create";
            })->name('caretakers.create');

            //tenants
            Route::get('/tenants/index', function () {
                return "/landlord/tenants/index";
            })->name('tenants');
            Route::get('/tenants/create', function () {
                return "landlord.tenants.create";
            })->name('tenants.create');
        });
    }
);
