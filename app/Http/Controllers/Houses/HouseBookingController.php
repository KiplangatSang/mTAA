<?php

namespace App\Http\Controllers\Houses;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\BookedHouses;
use App\Models\Plots\Houses;
use Illuminate\Http\Request;

class HouseBookingController extends BaseController
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        # code...
        $houses = $this->user()->houseBooking()->with('house')->simplePaginate($this->housePagination());
        $homedata['houses'] = $houses;

        return view('houses.booking.index', compact('homedata'));
    }

    public function show($id)
    {
        # code...
        $house = Houses::where('id', $id)
            ->with('plotLocation.landlord.caretaker')
            ->with('housable')
            ->with('caretaker')
            ->first();
        $housedata['house'] = $house;
        return view('houses.booking.show', compact('housedata'));
    }
    public function store(Request $request)
    {
        # code...

        $house = Houses::where('id', $request->house)->first();

        $result =  $this->user()->houseBooking()->updateOrCreate(
            ['house_id' => $house->id,],
            []
        );
        if (!$result) {
            return back()->with('error', "Could not add this to your bookings, it could be a duplicate");
        }
        return redirect(route('houses.booked'))->with('success', " House added to your bookings and the owner has been notified");
    }

    public function pay($id)
    {
        $house = $this->user()->houseBooking()
            ->where('id', $id)
            ->with('house.plotLocation.landlord.caretaker')
            ->first();

        $housedata['house'] = $house;
        return view('houses.booking.payment.show', compact('housedata'));
    }

    public function destroy($id)
    {
        # code...
        $result = BookedHouses::destroy($id);

        if (!$result) {
            return back()->with('error', 'Could not remove this booking');
        }
        return back()->with('success', 'Booking removed');
    }
}
