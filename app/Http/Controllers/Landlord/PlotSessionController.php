<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Plots\PlotLocation;
use Illuminate\Http\Request;

class PlotSessionController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $sessiondata['plots'] = null;
        $plots = null;
        $user = $this->user();
        if ($user->role == 2) {
            $plots = $this->user()->landlord()->first()->plotlocations()->get();
        } else if ($user->role == 3) {
            $plots = $this->user()->caretaker()->first()->plotlocations()->get();
        }

        $sessiondata['plots'] = $plots;
        if (count($plots) == 1) {
            $request = new Request();
            $request['plot'] =  $plots->first()->id;
            $this->store($request);

            return redirect(route('landlord.home'));
        } else if (count($plots) < 1) {
            return redirect(route('landlord.plotlocation.create'));
        } else if (count($plots) > 1) {
            return view('session.plots.index', compact('sessiondata'));
        }
    }

    public function store(Request $request)
    {
        # code...

        $this->user()->sessionPlot()->updateOrCreate(
            [
                'user_id' => $this->user()->id,
            ],
            [
                'plot_location_id' => $request->plot
            ]
        );

        return redirect(route('landlord.home'));
    }

    public function show()
    {
        # code...
        $this->middleware('plotregister');
        $this->middleware('plotsession');
        $sessionplot = $this->user()->sessionPlot()->first();
        $id = $sessionplot->plot_location_id;
        $plot = PlotLocation::where('id', $id)
            ->with('plot_locationable')
            ->first();
        return $plot;
    }
}
