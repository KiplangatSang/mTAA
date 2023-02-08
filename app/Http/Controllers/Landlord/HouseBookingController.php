<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\BookedHouses;
use App\Models\Plots\Houses;
use Illuminate\Http\Request;

class HouseBookingController extends Controller
{
    //

    public function index()
    {
        # code...
    }

    public function show($id)
    {
        # code...
        $house = Houses::where('id', $id)
            ->whereHas('booked')
            ->with('plotLocation')
            ->with('housable')
            ->with('caretaker')
            ->with('booked.bookable.tenant')
            ->first();
        $housedata['house'] = $house;
        return view('landlord.houses.booking.show', compact('housedata'));
    }
}