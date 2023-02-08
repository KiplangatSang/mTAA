<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Houses\HouseBookingController;
use App\Http\Controllers\Landlord\HouseBookingController as LandlordHouseBookingController;
use App\Http\Controllers\Landlord\HouseController;
use App\Http\Controllers\Landlord\PlotLocationController;
use App\Http\Controllers\Landlord\PlotSessionController;
use App\Http\Controllers\WelcomeController;
use App\Models\Plots\Houses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/search-houses', [WelcomeController::class, 'search'])->name('search-houses');

Route::get('/houses/book/show/{id}', [HouseBookingController::class, 'show'])->name('houses.book');
Route::get('/houses/book/pay/{id}', [HouseBookingController::class, 'pay'])->name('houses.book.pay');

Route::post('/houses/book/store', [HouseBookingController::class, 'store'])->name('houses.book.store');
Route::get('/houses/book/index', [HouseBookingController::class, 'index'])->name('houses.booked');
Route::get('/houses/book/destroy/{id}', [HouseBookingController::class, 'destroy'])->name('houses.booked.delete');

Route::get('/houses', function () {
    return redirect(route('home'));
})->name('houses');

//landlords
Route::get('/landlord/home', [HomeController::class,'landlord'])->name('landlord.home');
Route::get('/landlord/houses', function () {
    return "houses";
})->name('landlord.houses');
Route::get('/landlord/house/bookings', function () {
    return "houses";
})->name('landlord.house.bookings');
Route::get('/landlord/caretakers', function () {
    return "caretakers";
})->name('landlord.caretakers');
Route::get('/landlord/accounts', function () {
    return "Accounts";
})->name('landlord.accounts');
Route::get('/landlord/tenants', function () {
    return "tenants";
})->name('landlord.tenants');

//plot location
Route::get('/landlord/plots/index', [PlotLocationController::class, 'index'])->name('landlord.plotlocation');
Route::get('/landlord/plots/create', [PlotLocationController::class, 'create'])->name('landlord.plotlocation.create');
Route::post('/landlord/plots/store', [PlotLocationController::class, 'store'])->name('landlord.plotlocation.store');
Route::get('/landlord/plots/show/{id}', [PlotLocationController::class, 'show'])->name('landlord.plotlocation.show');
Route::get('/landlord/plots/edit/{id}', [PlotLocationController::class, 'edit'])->name('landlord.plotlocation.edit');
Route::post('/landlord/plots/update/{id}', [PlotLocationController::class, 'update'])->name('landlord.plotlocation.update');

//session plot
Route::get('/session/plot', [PlotSessionController::class, 'index'])->name('session.plotlocation.index');
Route::post('/session/plot', [PlotSessionController::class, 'store'])->name('session.plotlocation.store');




//houses
Route::get('/landlord/houses/index', [HouseController::class,'index'])->name('landlord.houses');
Route::get('/landlord/houses/create', [HouseController::class,'create'])->name('landlord.houses.create');
Route::get('/landlord/houses/show/{id}', [HouseController::class,'show'])->name('landlord.houses.show');
Route::get('/landlord/houses/delete/{id}', [HouseController::class,'destroy'])->name('landlord.houses.delete');
Route::post('/landlord/houses/store', [HouseController::class,'store'])->name('landlord.houses.store');

Route::post('/landlord/houses/upload/outsideimages', [HouseController::class,'uploadOutsideImages'])->name('houses.images.upload.outside');
Route::post('/landlord/houses/upload/insideimages', [HouseController::class,'uploadInsideImages'])->name('houses.images.upload.inside');

Route::get('/landlord/houses/delete/{id}', [HouseController::class,'destroy'])->name('landlord.houses.delete');

Route::get('/landlord/houses/boookings/{id}', [LandlordHouseBookingController::class,'show'])->name('landlord.houses.booked.show');
Route::post('/landlord/houses/payment/refund/{house_id}', [LandlordHouseBookingController::class,'refund'])->name('landlord.payment.reverse');
Route::post('/landlord/houses/tenant/store/{house_id}/{tenant_id}', [LandlordHouseBookingController::class,'tenant_accept'])->name('landlord.houses.tenant.store');
Route::get('/landlord/houses/tenant/request_payment/{house_id}/{tenant_id}', [LandlordHouseBookingController::class,'tenant_requet_payment'])->name('landlord.houses.tenant.requet-payment');



Route::get('/landlord/houses/types', function () {
    return "landlord.houses.types";
})->name('landlord.houses.types');


//caretakers
Route::get('/landlord/caretakers/index', function () {
    return "/landlord/caretakers/index";
})->name('landlord.caretakers');
Route::get('/landlord/caretakers/create', function () {
    return "landlord.caretakers.create";
})->name('landlord.caretakers.create');

//tenants
Route::get('/landlord/tenants/index', function () {
    return "/landlord/tenants/index";
})->name('landlord.tenants');
Route::get('/landlord/tenants/create', function () {
    return "landlord.tenants.create";
})->name('landlord.tenants.create');
