<?php

namespace App\Http\Controllers\Landlord;

use App\Http\Controllers\BaseController;
use App\Http\Controllers\Controller;
use App\Models\CaretakerRoles;
use App\Models\Landlords\Caretakers;
use Illuminate\Http\Request;

class CaretakerController extends BaseController
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
        $caretakers =  $this->plotsession()->caretaker()->with('user')
            ->with('plotlocations')
            ->with('houses')
            ->with('landlord.landlordable')
            ->get();
        $caretakersdata['caretakers'] =  $caretakers;
        return view('landlord.caretaker.index', compact('caretakersdata'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $caretakers =  $this->plotsession()->caretaker()
            ->where('id', $id)
            ->with('user')
            ->with('plotlocations')
            ->with('houses')
            ->with('landlord.landlordable')
            ->first();
        $caretakersdata['caretaker'] =  $caretakers;
        return view('landlord.caretaker.show', compact('caretakersdata'));
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
        $caretakers =  $this->plotsession()->caretaker()
            ->where('id', $id)
            ->with('user')
            ->with('roles')
            ->first();

        $caretakerroles = CaretakerRoles::where('status', true)->get();
        $caretakerroles = CaretakerRoles::all();
        $caretakersdata['caretaker'] =  $caretakers;
        $caretakersdata['caretakerroles'] =  $caretakerroles;

        // dd( $caretakersdata['caretaker']);
        return view('landlord.caretaker.edit', compact('caretakersdata'));
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
        $caretaker =  Caretakers::where('id', $id)->first();
        $result =  $caretaker->update(
            $request->all()
        );
        if ($result)
            return redirect(route('landlord.caretakers.show',["caretaker=>$id"]))->with('success', "The caretaker account has been updated successfully");
        else
            return back()->with('error', "The caretaker account could not be updated");
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
        $result =  Caretakers::destroy($id);
        if ($result)
            return redirect(route('landlord.caretakers.index'))->with('success', "The caretaker account has been deleted successfully");

        else
            return back()->with('error', "The caretaker account could not be deleted");
    }
}
