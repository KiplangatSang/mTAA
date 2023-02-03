<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlotLocationController extends BaseController
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $plot_location_data['plot_location'] = $this->user()->landlord()->first()->plotlocations()->get();
        return  view('landlord.plotlocation.index', compact('plot_location_data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('landlord.plotlocation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        request()->validate([
            'name' => 'required',
            'no_of_houses' => 'required',
            'house_types' => 'required',
            'town' => 'required',
            'constituency' => 'required',
            'county' => 'required',
            'country' => 'required',
        ]);

        $request['house_types'] = json_encode($request->house_types);

        $result =  $this->user()->landlord()->first()->plotlocations()->create(
            $request->all(),
            ["landlord_id" => auth()->id(),],
        );

        if (!$result)
            return back()->with('error', "Sorry! Could not register at this time. Please wait for a while");

        return redirect(route('landlord.plotlocation'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        $plot_location_data['plot'] = $this->user()->landlord()->first()->plotlocations()
            ->where('id', $id)
            ->with('plot_locationable.landlordable')
            ->with('caretaker.caretakerable')
            ->with('houses')
            ->with('tenants')
            ->first();
        return  view('landlord.plotlocation.show', compact('plot_location_data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $plot_location_data['plot'] = $this->user()->landlord()->first()->plotlocations()
        ->where('id', $id)
        ->with('plot_locationable.landlordable')
        ->with('caretaker.caretakerable')
        ->with('houses')
        ->with('tenants')
        ->first();
    return  view('landlord.plotlocation.edit', compact('plot_location_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $plot= $this->user()->landlord()->first()->plotlocations()
        ->where('id', $id)
        ->first();

        if ($request->house_types) {
            $house_types = json_decode($plot->house_types);
            $house_types = array_merge((array)$house_types, $request->house_types);
            $request['house_types'] = json_encode($house_types);
        }
        $plot->update(
            request()->all(),
        );

        return redirect(route('landlord.plotlocation.show',[$id=> $plot->id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
