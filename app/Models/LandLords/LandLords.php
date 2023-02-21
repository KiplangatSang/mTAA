<?php

namespace App\Models\LandLords;

use App\Models\Landlords\Caretakers;
use App\Models\Plots\Houses;
use App\Models\Plots\PlotLocation;
use App\Models\Profile;
use App\Models\Tenants\Tenants;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandLords extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function landlordable()
    {
        # code...
        return $this->morphTo();
    }

    public function tenants()
    {
        # code...
        return $this->hasMany(Tenants::class,'landlords_tenants');
    }


    public function user()
    {
        # code...
      return  $this->morphOne(User::class,'userable');
    }

    public function caretakers()
    {
        # code...
       return $this->belongsTo(Caretakers::class,'landlord_id');
    }

    public function plotlocations()
    {
        # code...
       return $this->morphMany(PlotLocation::class,'plot_locationable');
    }

    public function houses()
    {
        # code...
       return $this->morphMany(Houses::class,'houseable');
    }

    public function payment()
    {
        # code...
       return $this->morphMany(Payment::class,'payable');
    }

    public function paymentReceived()
    {
        # code...
       return $this->hasMany(Payment::class,'landlord_id');
    }

    public function profile()
    {
        # code...
        return $this->morphOne(Profile::class,'profileable');
    }

    public function houseProfile()
    {
        # code...
        return $this->hasOne(Profile::class,'landlord_id');
    }
}
