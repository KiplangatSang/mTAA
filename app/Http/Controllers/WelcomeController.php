<?php

namespace App\Http\Controllers;

use App\Models\Plots\Houses;
use Illuminate\Http\Request;

class WelcomeController extends BaseController
{
    protected $search = null;

    public function search(Request $request)
    {
        # code...
        $housepagination = $this->housePagination();
        $result = null;
        if ($request->has('country')) {
            $this->search = $request->country;
            $result = Houses::with('PlotLocation')->where('available', 1)->whereHas('PlotLocation', function ($q) {
                $q->where('country', 'LIKE', '%' . $this->search . '%');
            })->simplePaginate($housepagination);
        } elseif ($request->has('county')) {
            $this->search = $request->county;
            $result = Houses::with('PlotLocation')->where('available', 1)->whereHas('PlotLocation', function ($q) {
                $q->where('county', 'LIKE', '%' . $this->search . '%');
            })->simplePaginate($housepagination);
        } elseif ($request->has('city')) {
            $this->search = $request->city;
            $result = Houses::with('PlotLocation')->where('available', 1)->whereHas('PlotLocation', function ($q) {
                $q->where('city', 'LIKE', '%' . $this->search . '%');
            })->simplePaginate($housepagination);
        } elseif ($request->has('town')) {
            $this->search = $request->town;
            $result = Houses::with('PlotLocation')->where('available', 1)->whereHas('PlotLocation', function ($q) {
                $q->where('town', 'LIKE', '%' . $this->search . '%');
            })->simplePaginate($housepagination);
        } else if ($request->has('type')) {
            $this->search = $request->type;
            $result = Houses::with('PlotLocation')->where('available', 1)->where('type', 'LIKE', '%' . $this->search . '%')->simplePaginate($housepagination);
        } else {
            $result = Houses::simplePaginate($housepagination);
        }

        return $this->index($result);
    }

    public function index($data)
    {
        # code...
        $homedata['houses'] = $data;
        return view('welcome', compact("homedata"));
    }
}
