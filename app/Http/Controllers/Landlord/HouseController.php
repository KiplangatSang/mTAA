<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Plots\Houses;
use Illuminate\Http\Request;

class HouseController extends BaseController
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
        $houses = $this->plotsession()->houses()->get();
        $housedata['houses'] = $houses;
        return view('landlord.houses.index', compact('housedata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        //
        $houses = $this->plotsession()->houses()
            ->with('profile')
            ->get();
        $housedata['houses'] = $houses;
        return view('landlord.houses.create', compact('housedata'));
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
        $this->plotsession()->houses()->store(
            $request->all(),
        );
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
        $house = $this->plotsession()->houses()->where('id', $id)->first();
        $housedata['house'] = $house;
        return view('landlord.houses.show', compact('housedata'));
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
        Houses::destroy($id);
    }

    public function uploadOutsideImages($house_id, Request $request)
    {
        $user = $this->user();
        $house = Houses::where('id', $house_id)->with('plot_location')->first();

        # code...
        $fileNameToStore = $this->getBaseImages()['nofile'];
        if (request()->hasFile('file')) {
            $fileNameToStore = $this->saveFile($house->id . "/insideimages", request()->file('file'));
            info("File" . $fileNameToStore);
        } else
            info("No File " . $fileNameToStore);

        $pictures = null;

        // check if there are documents available and append
        if ($house->pictures) {
            $pictures = (array)json_decode($house->pictures);
        }
        $pictures['outsideimages'] = $fileNameToStore;



        $house->update([
            "pictures" => json_encode($pictures),
        ]);

        return 200;
        # code...
    }
    public function uploadInsideImages($house_id, Request $request)
    {
        # code...
        $user = $this->user();
        $house = Houses::where('id', $house_id)->with('plot_location')->first();

        # code...
        $fileNameToStore = $this->getBaseImages()['nofile'];
        if (request()->hasFile('file')) {
            $fileNameToStore = $this->saveFile($house->id . "/insideimages", request()->file('file'));
            info("File" . $fileNameToStore);
        } else
            info("No File " . $fileNameToStore);

        $documents = null;

        // check if there are documents available and append
        if ($house->pictures) {
            $pictures = (array)json_decode($house->pictures);
        }
        $pictures['insideimages'] = $fileNameToStore;



        $house->update([
            "pictures" => json_encode($pictures),
        ]);

        return 200;
    }
}
