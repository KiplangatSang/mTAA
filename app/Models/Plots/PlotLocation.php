<?php

namespace App\Models\Plots;

use App\Models\Landlords\Caretakers;
use App\Models\Tenants\Tenants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlotLocation extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function plot_locationable()
    {
        # code...
        return $this->morphTo();
    }

    public function caretaker()
    {
        # code...
        return $this->belongsTo(Caretakers::class,'caretaker_id');
    }

    public function tenants()
    {
        # code...

        return $this->belongsToMany(Tenants::class,'plot_locations_tenants');
    }

    public function houses()
    {
        # code...
        return $this->hasMany(Houses::class,'plot_location_id');
    }
}
