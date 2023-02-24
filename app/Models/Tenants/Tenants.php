<?php

namespace App\Models\Tenants;

use App\Models\Landlords\Caretakers;
use App\Models\LandLords\LandLords;
use App\Models\Payment;
use App\Models\Plots\Houses;
use App\Models\Plots\PlotLocation;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenants extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function tenantable()
    {
        # code...
        return $this->morphTo();
    }

    public function landlords()
    {
        # code...
        return $this->belongsToMany(LandLords::class, 'landlords_tenants');
    }

    public function caretakers()
    {
        # code...
        return $this->belongsToMany(Caretakers::class, 'caretakers_tenant');
    }

    public function plotlocation()
    {
        # code...
        return $this->belongsToMany(PlotLocation::class, 'plot_locations_tenants');
    }

    public function houses()
    {
        # code...
        return $this->hasMany(Houses::class, 'tenant_id');
    }

    public function payment()
    {
        # code...
        return $this->morphMany(Payment::class, 'payable');
    }

    public function paymentReceived()
    {
        # code...
        return $this->hasMany(Payment::class, 'tenant_id');
    }
}
