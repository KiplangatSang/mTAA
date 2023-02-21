<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\Plots\Houses;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HouseController extends BaseController
{
    protected  $str_length = 7;
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

        if ($request->has('action') && $request->action == "close")
            return redirect(route('landlord.houses'))->with('success', "The house has been added successfully");


        $str_length = $this->str_length;;
        $house_id =  Str::random($str_length);
        $request['house_id'] = $house_id;
        $request['plot_location_id'] = $this->plotsession()->id;

        //save the house
        $house = $this->plotsession()->plot_locationable()->first()->houses()->create(

            $request->except('image', 'imageUrl', '_token'),

        );

        //save profile
        //get a no file image as default image
        $fileNameToStore = $this->getBaseImages()['nofile'];

        //check  if image is uploaded or image url copied
        if (request()->hasFile('image')) {
            $fileNameToStore = $this->saveFile($house->id . "/profile-image", request()->file('image'));
            info("File" . $fileNameToStore);
        } else if (request()->has('imageUrl')) {
            $fileNameToStore = $request->imageUrl;
            info("No File " . $fileNameToStore);
        }

        //save profile
        $profile = $house->profile()->updateOrCreate(
            [],
            [
                'profile_image' => $fileNameToStore,
                'user_id' => $this->user()->id,
            ]
        );

        if (!$profile)
            return redirect(route('landlord.houses.create'))->with('error', "Error uploading image");

        session()->put('house', $house);

        return redirect(route('landlord.houses.create'))->with('success', "The house has been added successfully");
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

    public function uploadOutsideImages(Request $request)
    {
        $house_id = $request->house;
        $user = $this->user();
        $house = Houses::where('id', $house_id)->with('plotLocation')->first();

        # code...
        $fileNameToStore = $this->getBaseImages()['nofile'];
        if (request()->hasFile('file')) {
            $fileNameToStore = $this->saveFile($house->plotLocation->name . "/" . $house->id  . "/insideimages", request()->file('file'));
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
    public function uploadInsideImages(Request $request)
    {
        # code...
        $user = $this->user();
        $house_id = $request->house;
        $house = Houses::where('id', $house_id)->with('plotLocation')->first();
        // info($request->all());
        // info($house);

        # code...
        $fileNameToStore = $this->getBaseImages()['nofile'];
        if (request()->hasFile('file')) {
            $fileNameToStore = $this->saveFile($house->plotLocation->name . "/" . $house->id . "/insideimages", request()->file('file'));
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
