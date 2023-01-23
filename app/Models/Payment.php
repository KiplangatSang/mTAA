<?php

namespace App\Models;

use App\Models\LandLords\LandLords;
use App\Models\Plots\Houses;
use App\Models\Tenants\Tenants;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function payable()
    {
        # code...
        return $this->morphTo();
    }

    public function house()
    {
        # code...
        return $this->belongsTo(Houses::class,'house_id');
    }

    public function tenants()
    {
        # code...
        return $this->belongsTo(Tenants::class,'tenants_id');
    }

    public function landlords()
    {
        # code...
        return $this->belongsTo(LandLords::class,'landlord_id');
    }
}
