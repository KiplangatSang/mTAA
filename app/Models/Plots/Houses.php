<?php

namespace App\Models\Plots;

use App\Models\Landlords\Caretakers;
use App\Models\Payment;
use App\Models\Tenants\Tenants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Houses extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function housable()
    {
        # code...
        return $this->morphTo();

    }

    public function cartaker()
    {
        # code...
        return $this->belongsTo(Caretakers::class,'caretaker_id');
    }

    public function plotLocation()
    {
        # code...
        return $this->belongsTo(PlotLocation::class,'plot_location_id');
    }

    public function tenant()
    {
        # code...
        return $this->belongsTo(Tenants::class,'tenant_id');
    }

    public function payment()
    {
        # code...
        return $this->hasOne(Payment::class,'house_id');
    }
}
