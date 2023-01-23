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

    public function plotLocationable()
    {
        # code...
        return $this->morphTo();
    }

    public function caretakers()
    {
        # code...
        return $this->belongsTo(Caretakers::class,'caretaker_id');
    }

    public function tenants()
    {
        # code...

        return $this->hasMany(Tenants::class,'plot_locations_tenants');
    }

    public function houses()
    {
        # code...
        return $this->hasMany(Houses::class,'plot_location_id');
    }
}
