<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\Controller;
use App\Models\BookedHouses;
use App\Models\Plots\Houses;
use Illuminate\Http\Request;

class HouseBookingController extends Controller
{
    //
    public function __construct()
    {
       $this->middleware('auth');
    }

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
            ->with('houseable')
            ->with('caretaker')
            ->with('booked.bookable.tenant')
            ->with('payments.payable')
            ->first();
        if (!$house)
            return back()->with('error', 'This house has no recent bookings');
        $housedata['house'] = $house;

        return view('landlord.houses.booking.show', compact('housedata'));
    }
}
