<?php

namespace App\Http\Controllers;

use App\Models\Plots\Houses;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if ($this->user()->role == 1) {
            //tenants account
            $tenants = $this->user()->tenant()
                ->with('houses')->first();
            $homedata['houses'] = $tenants->houses;
            return view('users.home', compact('homedata'));
        } else if ($this->user()->role == 2) {
            return redirect(route('session.plotlocation.index'));
        }
    }

    public function landlord()
    {
        # code...
        if ($this->plotsession()) {
            $plotSession = $this->plotsession();
            return view("landlord.home", compact('plotSession'));
        }
    }
}
