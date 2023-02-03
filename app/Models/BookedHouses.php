<?php

namespace App\Models;

use App\Models\Plots\Houses;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedHouses extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function bookable()
    {
        # code...
        return $this->morphTo();
    }

    public function house()
    {
        # code...
        return $this->belongsTo(Houses::class,"house_id");
    }
}
