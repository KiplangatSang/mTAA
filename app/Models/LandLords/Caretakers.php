<?php

namespace App\Models\Landlords;

use App\Models\CaretakerRoles;
use App\Models\LandLords\LandLords;
use App\Models\Plots\Houses;
use App\Models\Plots\PlotLocation;
use App\Models\Profile;
use App\Models\Tenants\Tenants;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Caretakers extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function caretakerable()
    {
        # code...
        return $this->morphTo();
    }

    public function tenants()
    {
        # code...
       return $this->belongsToMany(Tenants::class,'caretakers_tenant');
    }

    public function landlord()
    {
        # code...
       return $this->belongsTo(LandLords::class,'landlord_id');
    }

    public function houses()
    {
        # code...
       return $this->hasMany(Houses::class,'caretaker_id');
    }

    public function plotlocations()
    {
        # code...
       return $this->hasMany(PlotLocation::class,'caretaker_id');
    }

    public function profile()
    {
        # code...
        return $this->morphOne(Profile::class,'profileable');
    }

    public function houseProfile()
    {
        # code...
        return $this->hasOne(Profile::class,'caretaker_id');
    }

    public function user()
    {
        # code...
        return $this->belongsTo(User::class,'user_id');
    }

    public function roles()
    {
        # code...
        return $this->belongsTo(CaretakerRoles::class,'role');
    }
}
